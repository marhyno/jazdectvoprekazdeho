$('.onlineTestButtonHorseParts').on('click', function () {
  $('#horsePartsOnlineTest').show();
});

(function () {

  var questions = [
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/0.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/1.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/2.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/3.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/4.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/5.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/6.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/7.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/8.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/9.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/10.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/11.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/12.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/13.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/14.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/15.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/16.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/17.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/18.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/19.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/20.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/21.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/22.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/23.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/24.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/25.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/26.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/27.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/28.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/29.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/30.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/31.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/32.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/33.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/34.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/35.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/36.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/37.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/38.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/39.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/40.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/41.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/42.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/43.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/44.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/45.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/46.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/47.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/48.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/49.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/50.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/51.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/52.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/53.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/54.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/55.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/56.png'>",
      choices: [
        "Federation Equestre International (FEI)",
        "Štátna jazdecká federácia (ŠJF)",
        "Medzinárodná jazdecká federácia (MJF)",
        "Slovenská jazdecká federácia (SJF)"],
      correctAnswer: 3
    }
  ];

  var questionCounter = 0; //Tracks question number
  var selections = []; //Array containing user choices
  var quiz = $('#horsePartsQuiz'); //Quiz div object
  shuffle(questions);
  // Display initial question
  displayNext();

  // Click handler for the 'next' button
  $("#horsePartsOnlineTest").find('#next').on('click', function (e) {
    e.preventDefault();

    // Suspend click listener during fade animation
    if (quiz.is(':animated')) {
      return false;
    }
    choose();

    // If no user selection, progress is stopped
    if (isNaN(selections[questionCounter])) {
      warningAnimation('Vyberte jednu možnosť!');
    } else {
      questionCounter++;
      displayNext();
    }
  });

  // Click handler for the 'prev' button
  $("#horsePartsOnlineTest").find('#prev').on('click', function (e) {
    e.preventDefault();

    if (quiz.is(':animated')) {
      return false;
    }
    choose();
    questionCounter--;
    displayNext();
  });

  // Click handler for the 'Start Over' button
  $("#horsePartsOnlineTest").find('#start').on('click', function (e) {
    shuffle(questions); //shuffle questions
    e.preventDefault();

    if (quiz.is(':animated')) {
      return false;
    }
    questionCounter = 0;
    selections = [];
    displayNext();
    $('#start').hide();
  });

  // Animates buttons on hover
  $('.button').on('mouseenter', function () {
    $(this).addClass('active');
  });
  $('.button').on('mouseleave', function () {
    $(this).removeClass('active');
  });

  // Creates and returns the div that contains the questions and 
  // the answer selections
  function createQuestionElement(index) {
    var qElement = $('<div>', {
      id: 'question'
    });

    var header = $('<h2>Otázka ' + (index + 1) + ' z ' + questions.length + ':</h2>');
    qElement.append(header);

    var question = $('<p class="questionTitle">').append(questions[index].question);
    qElement.append(question);

    var radioButtons = createRadios(index);
    qElement.append(radioButtons);

    return qElement;
  }

  // Creates a list of the answer choices as radio inputs
  function createRadios(index) {
    var radioList = $('<ul>');
    var item;
    var input = '';
    for (var i = 0; i < questions[index].choices.length; i++) {
      item = $('<li>');
      input = '<label><input type="radio" name="answer" value=' + i + ' />';
      input += '<div class="questionOption">' + questions[index].choices[i] + '</div></label>';
      item.append(input);
      radioList.append(item);
    }
    return radioList;
  }

  // Reads the user selection and pushes the value to an array
  function choose() {
    selections[questionCounter] = +$('input[name="answer"]:checked').val();
  }

  // Displays next requested element
  function displayNext() {

    quiz.fadeOut(function () {
      $("#horsePartsOnlineTest").find('#question').remove();

      if (questionCounter < questions.length) {
        var nextQuestion = createQuestionElement(questionCounter);
        quiz.append(nextQuestion).fadeIn();
        if (!(isNaN(selections[questionCounter]))) {
          $("#horsePartsOnlineTest").find('input[value=' + selections[questionCounter] + ']').prop('checked', true);
        }

        // Controls display of 'prev' button
        if (questionCounter === 1) {
          $("#horsePartsOnlineTest").find('#prev').show();
        } else if (questionCounter === 0) {

          $("#horsePartsOnlineTest").find('#prev').hide();
          $("#horsePartsOnlineTest").find('#next').show();
        }
      } else {
        var scoreElem = displayScore();
        quiz.append(scoreElem).fadeIn();
        $("#horsePartsOnlineTest").find('#next').hide();
        $("#horsePartsOnlineTest").find('#prev').hide();
        $("#horsePartsOnlineTest").find('#start').show();
      }
    });
  }

  // Computes score and returns a paragraph element to be displayed
  function displayScore() {
    var score = $('<p>', { id: 'question' });

    var numCorrect = 0;
    for (var i = 0; i < selections.length; i++) {
      if (selections[i] === questions[i].correctAnswer) {
        numCorrect++;
      }
    }

    score.append('<h4>Dosiahli ste ' + numCorrect + ' správnych odpovedí z ' +
      questions.length + '</h4>');
    return score;
  }

  function shuffle(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
      j = Math.floor(Math.random() * (i + 1));
      x = a[i];
      a[i] = a[j];
      a[j] = x;
    }
    return a;
  }

  $("#horsePartsOnlineTest").find("#showAnswerHorseParts").on('click', function (e) {
    e.preventDefault();

    if ($("#horsePartsOnlineTest").find('[name=answer]:checked').val() != questions[questionCounter].correctAnswer) {
      $("#horsePartsOnlineTest").find('[name=answer]:checked').parent().parent().css('background-color', '#ff4b4b');
    }
    $("#horsePartsOnlineTest").find('#question').find("ul li:nth-child(" + (questions[questionCounter].correctAnswer + 1) + ")").css('background-color', 'lightgreen');
  })
})();


$(document).on('click', '#checkLargeArena', function () {
  $('.largeDressageArenaLetters').each(function () {
    if ($(this).val().toLowerCase() == $(this).attr('id').toLowerCase()) {
      $(this).css('background-color', 'lightgreen');
    } else {
      $(this).css('background-color', 'red');
    }
  })
});

$(document).on('click', '#checkSmallArena', function () {
  $('.smallDressageArenaLetters').each(function () {
    if ($(this).val().toLowerCase() == $(this).attr('id').toLowerCase()) {
      $(this).css('background-color', 'lightgreen');
    } else {
      $(this).css('background-color', 'red');
    }
  })
});

$(document).on('click', '#resetLargeArena', function () {
  $('.largeDressageArenaLetters').each(function () {
    $(this).val('');
    $(this).css('background-color', 'lightgray');
  })
});

$(document).on('click', '#resetSmallArena', function () {
  $('.smallDressageArenaLetters').each(function () {
    $(this).val('');
    $(this).css('background-color', 'lightgray');
  })
});