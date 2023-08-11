// ローディング画面

// 幾何学模様
if (typeof tsParticles !== "undefined") {
  tsParticles.load("particles-js", {
    particles: {
      number: { value: 99, density: { enable: !0, value_area: 800 } },
      color: { value: "#fdfdfd" },
      shape: {
        type: "circle",
        stroke: { width: 0, color: "#fdfdfd" },
        polygon: { nb_sides: 5 },
        image: { src: "img/github.svg", width: 100, height: 100 },
      },
      opacity: {
        value: 0.5,
        random: !0,
        anim: { enable: !1, speed: 1, opacity_min: 0.1, sync: !1 },
      },
      size: {
        value: 3,
        random: !0,
        anim: { enable: !1, speed: 40, size_min: 0.1, sync: !1 },
      },
      line_linked: {
        enable: !0,
        distance: 150,
        color: "#fdfdfd",
        opacity: 0.4,
        width: 1,
      },
      move: {
        enable: !0,
        speed: 4,
        direction: "none",
        random: !0,
        straight: !1,
        out_mode: "out",
        bounce: !1,
        attract: { enable: !1, rotateX: 600, rotateY: 1200 },
      },
    },
    interactivity: {
      detect_on: "canvas",
      events: {
        onhover: { enable: !1, mode: "repulse" },
        onclick: { enable: !0, mode: "push" },
        resize: !0,
      },
      modes: {
        grab: { distance: 400, line_linked: { opacity: 1 } },
        bubble: { distance: 400, size: 40, duration: 2, opacity: 8, speed: 3 },
        repulse: { distance: 200, duration: 0.4 },
        push: { particles_nb: 4 },
        remove: { particles_nb: 2 },
      },
    },
    retina_detect: !0,
  });
}

//記事用目次
const table_of_contents = document.querySelectorAll(".table-of-contents");
let table_of_contents_counter = 1;
table_of_contents.forEach((table) => {
  const headings = table.parentElement.querySelectorAll(
    "h1, h2, h3, h4, h5, h6"
  );
  const stack = [{ level: 0, element: table }];

  headings.forEach((heading) => {
    const li = document.createElement("li");
    const a = document.createElement("a");
    const id = `section-${table_of_contents_counter++}`;
    const ol = document.createElement("ol");

    // 目次要素の生成
    a.textContent = heading.textContent;
    a.href = `#${id}`;
    li.appendChild(a);
    li.appendChild(ol);

    // リンク先の生成
    heading.id = id;
    heading.classList.add("anchor-link");

    // 階層構造の生成
    const level = Number(heading.tagName.substring(1));
    let parent;
    do {
      parent = stack.pop();
    } while (parent.level >= level);
    parent.element.appendChild(li);
    stack.push(parent);
    stack.push({ level: level, element: ol });
  });
});

// 404画面
function WordShuffler(holder, opt) {
  var that = this;
  var time = 0;
  this.now;
  this.then = Date.now();

  this.delta;
  this.currentTimeOffset = 0;

  this.word = null;
  this.currentWord = null;
  this.currentCharacter = 0;
  this.currentWordLength = 0;

  var options = {
    fps: 20,
    timeOffset: 5,
    textColor: "#000",
    fontSize: "50px",
    useCanvas: false,
    mixCapital: false,
    mixSpecialCharacters: false,
    needUpdate: true,
    colors: [
      "#f44336",
      "#e91e63",
      "#9c27b0",
      "#673ab7",
      "#3f51b5",
      "#2196f3",
      "#03a9f4",
      "#00bcd4",
      "#009688",
      "#4caf50",
      "#8bc34a",
      "#cddc39",
      "#ffeb3b",
      "#ffc107",
      "#ff9800",
      "#ff5722",
      "#795548",
      "#9e9e9e",
      "#607d8b",
    ],
  };

  if (typeof opt != "undefined") {
    for (key in opt) {
      options[key] = opt[key];
    }
  }

  this.needUpdate = true;
  this.fps = options.fps;
  this.interval = 1000 / this.fps;
  this.timeOffset = options.timeOffset;
  this.textColor = options.textColor;
  this.fontSize = options.fontSize;
  this.mixCapital = options.mixCapital;
  this.mixSpecialCharacters = options.mixSpecialCharacters;
  this.colors = options.colors;

  this.useCanvas = options.useCanvas;

  this.chars = [
    "V",
    "C",
    "B",
    "O",
    "R",
    "S",
    "U",
    "P",
    "T",
    "N",
    "さ",
    "ぽ",
    "ー",
    "と",
    "へ",
    "れ",
    "ん",
    "ら",
    "く",
    "し",
    "て",
    "く",
  ];
  this.specialCharacters = [
    "!",
    "§",
    "$",
    "%",
    "&",
    "/",
    "(",
    ")",
    "=",
    "?",
    "_",
    "<",
    ">",
    "^",
    "°",
    "*",
    "#",
    "-",
    ":",
    ";",
    "？",
  ];

  if (this.mixSpecialCharacters) {
    this.chars = this.chars.concat(this.specialCharacters);
  }

  this.getRandomColor = function () {
    var randNum = Math.floor(Math.random() * this.colors.length);
    return this.colors[randNum];
  };

  //if Canvas

  this.position = {
    x: 0,
    y: 50,
  };

  //if DOM
  if (typeof holder != "undefined") {
    this.holder = holder;
  }

  if (!this.useCanvas && typeof this.holder == "undefined") {
    console.warn(
      "Holder must be defined in DOM Mode. Use Canvas or define Holder"
    );
  }

  this.getRandCharacter = function (characterToReplace) {
    if (characterToReplace == " ") {
      return " ";
    }
    var randNum = Math.floor(Math.random() * this.chars.length);
    var lowChoice = -0.5 + Math.random();
    var picketCharacter = this.chars[randNum];
    var choosen = picketCharacter.toLowerCase();
    if (this.mixCapital) {
      choosen = lowChoice < 0 ? picketCharacter.toLowerCase() : picketCharacter;
    }
    return choosen;
  };

  this.writeWord = function (word) {
    this.word = word;
    this.currentWord = word.split("");
    this.currentWordLength = this.currentWord.length;
  };

  this.generateSingleCharacter = function (color, character) {
    var span = document.createElement("span");
    span.style.color = color;
    span.innerHTML = character;
    return span;
  };

  this.updateCharacter = function (time) {
    this.now = Date.now();
    this.delta = this.now - this.then;

    if (this.delta > this.interval) {
      this.currentTimeOffset++;

      var word = [];

      if (
        this.currentTimeOffset === this.timeOffset &&
        this.currentCharacter !== this.currentWordLength
      ) {
        this.currentCharacter++;
        this.currentTimeOffset = 0;
      }

      for (var k = 0; k < this.currentCharacter; k++) {
        word.push(this.currentWord[k]);
      }

      for (var i = 0; i < this.currentWordLength - this.currentCharacter; i++) {
        word.push(
          this.getRandCharacter(this.currentWord[this.currentCharacter + i])
        );
      }

      if (that.useCanvas) {
        c.clearRect(0, 0, stage.x * stage.dpr, stage.y * stage.dpr);
        c.font = that.fontSize + " sans-serif";
        var spacing = 0;
        word.forEach(function (w, index) {
          if (index > that.currentCharacter) {
            c.fillStyle = that.getRandomColor();
          } else {
            c.fillStyle = that.textColor;
          }
          c.fillText(w, that.position.x + spacing, that.position.y);
          spacing += c.measureText(w).width;
        });
      } else {
        if (that.currentCharacter === that.currentWordLength) {
          that.needUpdate = false;
        }
        this.holder.innerHTML = "";
        word.forEach(function (w, index) {
          var color = null;
          if (index > that.currentCharacter) {
            color = that.getRandomColor();
          } else {
            color = that.textColor;
          }
          that.holder.appendChild(that.generateSingleCharacter(color, w));
        });
      }
      this.then = this.now - (this.delta % this.interval);
    }
  };

  this.restart = function () {
    this.currentCharacter = 0;
    this.needUpdate = true;
  };

  function update(time) {
    time++;
    if (that.needUpdate) {
      that.updateCharacter(time);
    }
    requestAnimationFrame(update);
  }

  if (this.holder) {
    this.writeWord(this.holder.innerHTML);
    console.log(this.currentWord);
    update(time);
  }
}

var headline = document.getElementById("headline");
var text = document.getElementById("text");
var shuffler = document.getElementById("shuffler");

var headText = new WordShuffler(headline, {
  textColor: "#fff",
  timeOffset: 8,
  mixCapital: true,
  mixSpecialCharacters: true,
});

var pText = new WordShuffler(text, {
  textColor: "#fff",
  timeOffset: 2,
});

var buttonText = new WordShuffler(shuffler, {
  textColor: "tomato",
  timeOffset: 10,
});

if (shuffler) {
  shuffler.addEventListener("click", function () {
    headText.restart();
    pText.restart();
    buttonText.restart();
  });
}
