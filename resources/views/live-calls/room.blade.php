@extends('layouts.app')
@section('content')
    <div class="h-full flex flex-col bg-black text-white">
        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-3 border-b border-white/10">
            <div>
                <h2 class="text-xl font-semibold">Live Call</h2>
                <p class="text-sm text-zinc-400">
                    Mentor: {{ $call->mentor->name }} |
                    Room: {{ $call->jitsi_room }} |
                    Type: {{ strtoupper($call->status) }}
                </p>
            </div>
            {{-- Временно --}}
            {{-- <pre class="text-white">
                started_at: {{ $call->started_at }}
                minutes: {{ $call->minutes_purchased }}
                seconds: {{ $call->seconds_left }}
            </pre> --}}
            {{-- Конец Временно --}}
            <div class="flex items-center gap-4">
                <div id="timer" class="text-red-400 font-mono"></div>
                <form method="POST" action="/calls/{{ $call->id }}/end">
                    @csrf
                    <button class="bg-red-600 px-4 py-2 rounded hover:bg-red-700">
                        End Call
                    </button>
                </form>
            </div>
        </div>
        {{-- Video --}}
        <div class="mt-6 w-full h-[75vh] bg-black rounded-xl overflow-hidden relative">
            <div id="jitsi-container" class="w-full h-full"></div>
        </div>
    </div>
    <script>
        console.log("Jitsi API:", window.JitsiMeetExternalAPI);
        if (!window.JitsiMeetExternalAPI) {
            alert("Jitsi API not loaded");
        }
        // Limits from backend
        const LIMIT_MINUTES = {
            free: 15,
            trial: 30,
            paid: 120
        };
        const end = new Date("{{ $call->ended_at }}").getTime();
        let seconds = {{ $call->seconds_left }};
        seconds = Number(seconds);
        if (isNaN(seconds) || seconds < 0) seconds = 0;
        const timerEl = document.getElementById("timer");

        function renderTimer() {
            if (seconds < 0) seconds = 0;
            const m = Math.floor(seconds / 60);
            const s = String(seconds % 60).padStart(2, "0");
            timerEl.innerText = `Time left: ${m}:${s}`;
        }
        renderTimer();
        const interval = setInterval(() => {
            seconds--;
            if (seconds <= 0) {
                clearInterval(interval);
                timerEl.innerText = "Session ended";
                api.executeCommand("hangup");
                fetch("/live/room/{{ $call->id }}/end", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                });
                setTimeout(() => window.location = "/live-calls", 1500);
                return;
            }
            renderTimer();
        }, 1000);
        // Start Jitsi
        const domain = "meet.jit.si";

        const options = {
            roomName: "{{ $call->room }}",
            parentNode: document.getElementById("jitsi-container"),
            width: "100%",
            height: "100%",

            userInfo: {
                displayName: "{{ auth()->user()->name }}"
            },

            configOverwrite: {
                prejoinPageEnabled: false,
                startWithAudioMuted: true,
                startWithVideoMuted: false,
                disableDeepLinking: true,
                enableWelcomePage: false,
                enableClosePage: false,
                disableInviteFunctions: true,
                p2p: {
                    enabled: true
                }
            },

            interfaceConfigOverwrite: {
                FILM_STRIP_MAX_HEIGHT: 90,
                SHOW_JITSI_WATERMARK: false,
                SHOW_WATERMARK_FOR_GUESTS: false,
                TOOLBAR_ALWAYS_VISIBLE: true,
                HIDE_INVITE_MORE_HEADER: true,
                DISABLE_JOIN_LEAVE_NOTIFICATIONS: true,
                DEFAULT_BACKGROUND: "#000000"
            }
        };

        const api = new JitsiMeetExternalAPI(domain, options);

        api.addEventListener("participantJoined", (participant) => {
            if (participant.displayName === "{{ $call->mentor->name }}") {
                api.executeCommand("pinParticipant", participant.id);
                api.executeCommand("setTileView", false); // отключаем плитку
            }
        });
        // Save when user leaves
        api.addEventListener('readyToClose', () => {
            fetch("/calls/{{ $call->id }}/end", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            });
        });
        setInterval(() => {
            fetch("/live/room/{{ $call->id }}/tick", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.ended) {
                        api.executeCommand("hangup");
                        window.location = "/live-calls";
                    }
                });
        }, 1000);
    </script>
@endsection
