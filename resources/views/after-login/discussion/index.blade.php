@extends('layout.user')

@section('title', 'Diskusi')

@section('content')
<div class="container py-5">
    <h4 class="mb-4 text-center">Diskusi: {{ $course->nama }}</h4>

    <!-- Diskusi Baru -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <textarea id="discussionContent" class="form-control mb-3" rows="4" placeholder="Tulis diskusi..."></textarea>
            <button class="btn btn-primary w-100" onclick="sendDiscussion({{ $course->id }})">
                Kirim Diskusi
            </button>
        </div>
    </div>

    <!-- Daftar Komentar -->
    <div id="discussionList">
        @foreach($discussions as $discussion)
        <div class="card shadow-sm mb-3" id="discussion-{{ $discussion->id }}">
            <div class="card-body">
                <!-- Komentar Utama -->
                <div class="d-flex mb-2">
                    <div class="flex-shrink-0">
                        <img src="https://via.placeholder.com/40" class="rounded-circle" alt="{{ $discussion->user->name }}">
                    </div>
                    <div class="ms-3">
                        <strong>{{ $discussion->user->name }}</strong>
                        <p>{{ $discussion->content }}</p>
                        <small class="text-muted">{{ $discussion->created_at->diffForHumans() }}</small>
                    </div>
                </div>

                <!-- Balasan Komentar -->
                <div class="ms-4">
                    @foreach($discussion->replies as $reply)
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/40" class="rounded-circle" alt="{{ $reply->user->name }}">
                        </div>
                        <div class="ms-3">
                            <strong>{{ $reply->user->name }}</strong>
                            <p>{{ $reply->content }}</p>
                            <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @endforeach

                    <!-- Input Balasan -->
                    <div class="input-group mt-3">
                        <input type="text" class="form-control" id="reply-{{ $discussion->id }}" placeholder="Balas...">
                        <button class="btn btn-outline-secondary" onclick="sendReply({{ $discussion->id }})">Balas</button>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

    // Kirim diskusi baru
    function sendDiscussion(courseId) {
        let content = document.getElementById('discussionContent').value;
        if (!content) return;

        axios.post('{{ route("discussion.store") }}', {
                course_id: courseId,
                content
            })
            .then(res => {
                document.getElementById('discussionContent').value = '';
                location.reload(); // reload untuk tampilkan diskusi baru
            })
            .catch(err => {
                console.error('Gagal kirim diskusi', err.response || err);
                alert('Gagal mengirim diskusi');
            });
    }

    // Kirim balasan untuk diskusi
    function sendReply(discussionId) {
        let input = document.getElementById('reply-' + discussionId);
        let content = input.value;
        if (!content) return;

        axios.post('/discussion/' + discussionId + '/reply', {
                content
            })
            .then(res => {
                input.value = '';
                location.reload(); // reload untuk tampilkan reply baru
            })
            .catch(err => {
                console.error('Gagal kirim reply', err.response || err);
                alert('Gagal mengirim reply');
            });
    }
</script>
@endsection
