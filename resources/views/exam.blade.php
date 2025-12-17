<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/exam.css') }}">
    <title>Exam</title>
</head>

<body>

    <section>
        <h1>Start Your Challenge! </h1>
        <p>Get ready to test your knowledge! Answer the questions carefully and do your best. Each attempt brings you closer to becoming a true Challenger!</p>
    </section>


    <form method="POST" action="{{ route('exam.submit') }}">
        @csrf
        <h1>Questions</h1>

        @if(session('error'))
        <div style="color: red; margin-bottom: 20px; text-align: center; background-color: #eee; border-radius: 5px; padding:5px; width: fit-content; margin-left: auto; margin-right: auto;">
            {{ session('error') }}
        </div>
        @endif

        @foreach ($questions as $index => $question)
        <div class="question-parent">
            <span>{{ $question->question }} Q: {{$index + 1}}</span>

            <textarea rows="3" class="answer-text" readonly data-question="{{ $index }}">{{ $question->op1 }}</textarea>
            <textarea rows="3" class="answer-text" readonly data-question="{{ $index }}">{{ $question->op2 }}</textarea>
            <textarea rows="3" class="answer-text" readonly data-question="{{ $index }}">{{ $question->op3 }}</textarea>
            <textarea rows="3" class="answer-text" readonly data-question="{{ $index }}">{{ $question->op4 }}</textarea>

            <input type="hidden" name="answers[{{ $index }}]" id="answer-{{ $index }}">
            <p style="display: none;">Selected answer: <span id="display-{{ $index }}">None</span></p>
        </div>
        @endforeach


        <button class="submiter" type="submit">Submit Answers</button>
    </form>

    <script>
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                window.location.href = "{{ route('home') }}";
            }
        });
    </script>

    <script>
        const textareas = document.querySelectorAll('.answer-text');

        textareas.forEach(ta => {
            ta.addEventListener('click', function() {
                const questionIndex = this.dataset.question;
                const answer = this.textContent;

                document.getElementById('answer-' + questionIndex).value = answer;

                document.getElementById('display-' + questionIndex).textContent = answer;

                const siblings = this.parentNode.querySelectorAll('.answer-text');
                siblings.forEach(sib => {
                    sib.classList.remove('selected');
                    void sib.offsetWidth;
                });

                this.classList.add('selected');
            });
        });
    </script>
</body>

</html>