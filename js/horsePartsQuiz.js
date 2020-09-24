$('.onlineTestButtonHorseParts').on('click', function () {
  $('#horsePartsOnlineTest').show();
});

(function () {

  var questions = [
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/1.png'>",
      choices: [
        "bérec",
        "uhol dolnej čelusti",
        "líce",
        "štica"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/2.png'>",
      choices: [
        "sponka",
        "hrbol",
        "kríž",
        "žuchva"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/3.png'>",
      choices: [
        "líce",
        "puzdry",
        "gaštan",
        "dolná čelusť"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/4.png'>",
      choices: [
        "líce",
        "zadok",
        "štíca",
        "žuchva"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/5.png'>",
      choices: [
        "uhol dolnej čelusti",
        "brada",
        "bérec",
        "dolná čelusť"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/6.png'>",
      choices: [
        "hriva",
        "brada",
        "ústna štrbina",
        "dolný pysk"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/7.png'>",
      choices: [
        "ohíbie hlezna",
        "ústna štrbina",
        "lopatka",
        "horný pysk"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/8.png'>",
      choices: [
        "líce",
        "kríž",
        "spánok",
        "horný pysk"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/9.png'>",
      choices: [
        "nozdry",
        "líce",
        "brada",
        "kohútik"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/10.png'>",
      choices: [
        "bérec ",
        "štica",
        "nos",
        "uhol dolnej čelusti"],
      correctAnswer: 2
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/11.png'>",
      choices: [
        "ústna štrbina",
        "čelo",
        "hrbol",
        "väzi"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/12.png'>",
      choices: [
        "hrebeň krku",
        "kohútik",
        "zadok",
        "štica"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/13.png'>",
      choices: [
        "ucho",
        "hrebeň krku",
        "kríž",
        "šlacha"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/14.png'>",
      choices: [
        "spánok",
        "štica",
        "hrebeň krku",
        "väzi"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/15.png'>",
      choices: [
        "šlacha",
        "spánok",
        "bérec",
        "kríž"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/16.png'>",
      choices: [
        "uhol dolnej čelusti",
        "gaštan",
        "hrebeň krku",
        "hriva"],
      correctAnswer: 2
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/17.png'>",
      choices: [
        "hriva",
        "hrebeň krku",
        "horný pysk",
        "spánok"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/18.png'>",
      choices: [
        "kohútik",
        "hriva",
        "lopatka",
        "zadok"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/19.png'>",
      choices: [
        "stehno",
        "gaštan",
        "lopatka",
        "ohíbie hlezna"],
      correctAnswer: 2
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/20.png'>",
      choices: [
        "hrebeň krku",
        "chrbát",
        "hrbol",
        "bedrá"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/21.png'>",
      choices: [
        "korunka",
        "stehno",
        "zadok",
        "bedrá"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/22.png'>",
      choices: [
        "lopatka",
        "väzi",
        "sponkový kĺb",
        "kríž"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/23.png'>",
      choices: [
        "gaštan",
        "hrbol",
        "bérec",
        "chvost"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/24.png'>",
      choices: [
        "zadok",
        "gaštan",
        "korunka",
        "predkolenie"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/25.png'>",
      choices: [
        "zadok",
        "šlacha",
        "slabina",
        "koreň chvostu"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/26.png'>",
      choices: [
        "ohíbie hlezna",
        "sponka",
        "zadok",
        "chvost"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/27.png'>",
      choices: [
        "hrbol",
        "zadok",
        "zadná holeň",
        "stehno"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/28.png'>",
      choices: [
        "stehno",
        "predkolenie",
        "zadná holeň",
        "kríž"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/29.png'>",
      choices: [
        "korunka",
        "bérec",
        "sponka",
        "stehno"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/30.png'>",
      choices: [
        "gaštan",
        "kopyto",
        "šlacha",
        "zadná holeň"],
      correctAnswer: 2
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/31.png'>",
      choices: [
        "sponka",
        "hleznový kĺb",
        "slabina",
        "gaštan"],
      correctAnswer: 2
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/32.png'>",
      choices: [
        "šlacha",
        "spánok",
        "sponka",
        "zadná holeň"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/33.png'>",
      choices: [
        "pätový hrboľ",
        "sponkový kĺb",
        "šlacha",
        "ohíbie hlezna"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/34.png'>",
      choices: [
        "sponka",
        "predná holeň",
        "ostroha",
        "prsia"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/35.png'>",
      choices: [
        "kopyto",
        "predná holeň",
        "ostroha",
        "žilná ryha"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/36.png'>",
      choices: [
        "zadná holeň",
        "ramenný kĺb",
        "šlacha",
        "ohíbie hlezna"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/37.png'>",
      choices: [
        "zadná holeň",
        "pätový hrboľ",
        "holenný kĺb",
        "šlacha"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/38.png'>",
      choices: [
        "lakeť",
        "pätový hrboľ",
        "gaštan",
        "slabina"],
      correctAnswer: 2
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/39.png'>",
      choices: [
        "ostroha",
        "korunka",
        "gaštan",
        "predkolenie"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/40.png'>",
      choices: [
        "predná holeň",
        "stehno",
        "predkolenie",
        "holenný kĺb"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/42.png'>",
      choices: [
        "predkolenie",
        "hleznový kĺb",
        "podrebrie",
        "slabina"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/43.png'>",
      choices: [
        "bérec",
        "slabina",
        "žilná ryha",
        "podrebrie"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/44.png'>",
      choices: [
        "podrebrie",
        "slabina",
        "brucho",
        "pupočná časť"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/45.png'>",
      choices: [
        "kríž",
        "podrebrie",
        "bedrá",
        "slabina"],
      correctAnswer: 2
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/46.png'>",
      choices: [
        "podrebrie",
        "hleznový kĺb",
        "bérec",
        "hrudník"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/47.png'>",
      choices: [
        "predná holeň",
        "sponka",
        "hrudník",
        "lakeť"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/48.png'>",
      choices: [
        "ostroha",
        "gaštan",
        "predná holeň",
        "ramenný kĺb"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/49.png'>",
      choices: [
        "ostroha",
        "sponka",
        "lakeť",
        "holenný kĺb"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/50.png'>",
      choices: [
        "hrbol",
        "bérec",
        "lakeť",
        "predná holeň"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/51.png'>",
      choices: [
        "predná holeň",
        "lakeť",
        "zápästný kĺb",
        "prsia"],
      correctAnswer: 2
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/52.png'>",
      choices: [
        "lopatka",
        "prsia",
        "žilná ryha",
        "ramenný kĺb"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/53.png'>",
      choices: [
        "prsia",
        "žuchva",
        "bedrá",
        "prsia"],
      correctAnswer: 0
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/54.png'>",
      choices: [
        "hrudník",
        "hrbol",
        "kríž",
        "žilná ryha"],
      correctAnswer: 3
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/55.png'>",
      choices: [
        "žilná ryha",
        "hrdelnicová brázda",
        "bérec",
        "žuchva"],
      correctAnswer: 1
    },
    {
      question: "<img class='horseQuizImage' src='img/horsePartsQuiz/56.png'>",
      choices: [
        "čelo",
        "štica",
        "nos",
        "nadoční oblúk"],
      correctAnswer: 3
    },
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

    var question = $('<p class="questionTitle" style="text-align:center;">').append(questions[index].question);
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