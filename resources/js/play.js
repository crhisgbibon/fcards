"use strict";

// Messagebox
const messageBox = document.getElementById("messageBox");

// Controls
const pPlayButton = document.getElementById("pPlayButton");
const pScore = document.getElementById("pScore");
const pTotal = document.getElementById("pTotal");
const pDisplay = document.getElementById("pDisplay");
const pReset = document.getElementById("pReset");
// Select Menu
const playSelectMenu = document.getElementById("playSelectMenu");
const toggleDecks = document.getElementById("toggleDecks");
const toggleStacks = document.getElementById("toggleStacks");
const selectDeckPanel = document.getElementById("selectDeckPanel");
const selectStackPanel = document.getElementById("selectStackPanel");
const LoadSource = document.getElementById("LoadSource");

// Assignments
// Message Box
messageBox.onclick = function() { TogglePanel(messageBox); };
// Assignments
pPlayButton.onclick = function(){ ToggleDatabase(); AnimatePop(pPlayButton); };
pScore.onchange = function(){ AnimatePop(pScore); };
pTotal.onchange = function(){ AnimatePop(pTotal); };
pReset.onclick = function(){ ResetCount(); AnimatePop(pReset); };
toggleDecks.onclick = function(){ SwitchSelect(1); AnimatePop(toggleDecks); };
toggleStacks.onclick = function(){ SwitchSelect(2); AnimatePop(toggleStacks); };
LoadSource.onclick = function(){ Load(); AnimatePop(LoadSource); };

let sources = document.getElementsByClassName("source");

// Animation variables
let pFlashCardQuestion = document.getElementById("pFlashCardQuestion");
let pFlashCardAnswerContents = document.getElementById("pFlashCardAnswerContents");
let p, f, b, t;
let cardIndex = 0;
// Messagebox
let timeOut = undefined;
// Select
let currentSourceDiv = undefined;

// Startup
TogglePanel(messageBox);
SwitchSelect(2);
pPlayButton.style.backgroundColor = "var(--buttonBackgroundLight)";

function TogglePanel(panel)
{
  if(panel.style.display == "none") panel.style.display = "";
  else panel.style.display = "none";
}

function ToggleDatabase()
{
  TogglePanel(playSelectMenu);
  if(playSelectMenu.style.display === "")
  {
    pPlayButton.style.backgroundColor = "var(--buttonBackgroundLight)";
    AnimateFade(playSelectMenu);
  }
  else
  {
    pPlayButton.style.backgroundColor = "";
    AnimateFade(pDisplay);
  }
}

function SwitchSelect(num)
{
  if(num === 1)
  {
    selectDeckPanel.style.display = "";
    toggleDecks.style.backgroundColor = "var(--foregroundLight)";
    toggleDecks.style.color = "var(--background)";
    selectStackPanel.style.display = "none";
    toggleStacks.style.backgroundColor = "var(--buttonBackgroundLight)";
    toggleStacks.style.color = "";
    AnimateFade(selectDeckPanel);
  }
  else if(num === 2)
  {
    selectDeckPanel.style.display = "none";
    toggleDecks.style.backgroundColor = "var(--buttonBackgroundLight)";
    toggleDecks.style.color = "";
    selectStackPanel.style.display = "";
    toggleStacks.style.backgroundColor = "var(--foregroundLight)";
    toggleStacks.style.color = "var(--background)";
    AnimateFade(selectStackPanel);
  }
}

function MessageBox(message)
{
  messageBox.innerHTML = message;
  if(messageBox.style.display === "none") TogglePanel(messageBox);
  AnimatePop(messageBox);
  if(timeOut != null) clearTimeout(timeOut);
  timeOut = setTimeout(AutoOff, 2500);
}

function AnimatePop(panel)
{
  panel.animate([
    { transform: 'scale(110%, 110%)'},
    { transform: 'scale(109%, 109%)'},
    { transform: 'scale(108%, 108%)'},
    { transform: 'scale(107%, 107%)'},
    { transform: 'scale(106%, 106%)'},
    { transform: 'scale(105%, 105%)'},
    { transform: 'scale(104%, 104%)'},
    { transform: 'scale(103%, 103%)'},
    { transform: 'scale(102%, 102%)'},
    { transform: 'scale(101%, 101%)'},
    { transform: 'scale(100%, 100%)'}],
    {
      duration: 100,
    }
  );
}

function AnimateFade(panel)
{
  panel.animate(
  [
    { opacity: '0' },
    { opacity: '0.25' },
    { opacity: '0.5' },
    { opacity: '0.75' },
    { opacity: '1' }
  ],
  {
    duration: 500,
  }
  );
}

function AutoOff()
{
  messageBox.style.display = "none";
}

function MakeCurrent(source)
{
  currentSourceDiv = source;
  for(let i = 0; i < sources.length; i++)
  {
    if(source === sources[i])
    {
      sources[i].style.backgroundColor = "var(--foregroundLight)";
      sources[i].style.color = "var(--background)";
    }
    else
    {
      sources[i].style.backgroundColor = "var(--buttonBackgroundLight)";
      sources[i].style.color = "";
    }
  }
}

function Load()
{
  if(currentSourceDiv === undefined || currentSourceDiv === null)
  {
    alert("Please select a source.");
    return;
  }
  pDisplay.innerHTML = "";
  Post("NewCard");
  TogglePanel(playSelectMenu);
  pPlayButton.style.backgroundColor = "";
}

function NextCard(answer, index)
{
  cardIndex = index;
  if(answer === "right")
  {
    Post("RightAnswer");
  }
  else if(answer === "wrong")
  {
    Post("WrongAnswer");
  }
  Post("NewCard");
}

function ResetCount()
{
  Post("ResetCount");
}

function FlipCard(panel, front, back, backText)
{
  if(window.event.target.id === "moreLink") return;

  p = document.getElementById(panel);
  f = document.getElementById(front);
  b = document.getElementById(back);
  t = document.getElementById(backText);

  let pControl = document.getElementsByClassName("pControlDiv");
  Array.from(pControl).forEach((item) => {
    item.style.display = "none";
  });
  
  if(f.style.display === "")
  {
    AnimateFadeOut(f);
    AnimateFadeIn(b);
    AnimateFlip(true);
  }
  else
  {
    AnimateFadeIn(f);
    AnimateFadeOut(b);
    AnimateFlip(false);
  }

  setTimeout(SwitchSides, 250);
  setTimeout(ShowButtons, 500);
}

function SwitchSides()
{
  if(f.style.display === "")
  {
    f.style.display = "none";
    b.style.display = "";
    pFlashCardAnswerContents = document.getElementById("pFlashCardAnswerContents");
    pFlashCardAnswerContents.style.height = pFlashCardAnswerContents.scrollHeight + 'px';
  }
  else
  {
    f.style.display = "";
    b.style.display = "none";
  }
}

function ShowButtons()
{
  let pControl = document.getElementsByClassName("pControlDiv");
  Array.from(pControl).forEach((item) => {
    item.style.display = "";
    AnimateGrow(item);
  });
}

function AnimateGrow(item)
{
  item.animate(
    [
      { transform: "scale(0%)", opacity: '0' },
      { transform: "scale(50%)", opacity: '0.25' },
      { transform: "scale(100%)", opacity: '0.5' },
      { transform: "scale(125%)", opacity: '0.75' },
      { transform: "scale(100%)", opacity: '1' }
    ],
  { 
    duration: 250,
    easing: "ease-in-out",
  });
}

function AnimateFadeIn(p)
{
  p.animate(
    [
      { opacity: '0' },
      { opacity: '0.5' },
      { opacity: '1' },
      { opacity: '1' },
      { opacity: '1' }
    ],
  { 
    duration: 500,
    easing: "linear",
  });
}

function AnimateFadeOut(p)
{
  p.animate(
    [
      { opacity: '1' },
      { opacity: '0.5' },
      { opacity: '0' },
      { opacity: '0' },
      { opacity: '0' }
    ],
  { 
    duration: 500,
    easing: "linear",
  });
}

function AnimateFlip(isT)
{
  p.animate(
    [
      { transform: 'rotateY(180deg)' }
    ],
  { 
    duration: 500,
    easing: "linear",
  });

  if(isT)
  {
    t.animate(
      [
        { transform: 'rotateY(180deg)' }
      ],
    { 
      duration: 500,
      easing: "linear",
    });
  }
  else
  {
    f.animate(
      [
        { transform: 'rotateY(180deg)' }
      ],
    { 
      duration: 500,
      easing: "linear",
    });
  }
}

function Post(trigger)
{
  let data = [];

  if(trigger === "RightAnswer" || trigger === "WrongAnswer")
  {
    data = [
      cardIndex
    ];
  }
  if(trigger === "NewCard")
  {
    if(currentSourceDiv === undefined || currentSourceDiv === null)
    {
      data = [
        -1,
        -1
      ];
    }
    else
    {
      let type = currentSourceDiv.dataset.type;
      let sourceIndex = currentSourceDiv.dataset.value;
      data = [
        type,
        sourceIndex
      ];
    }
  }

  $.ajax(
  {
    method: "POST",
    url: '/play/' + trigger,
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      data:data
    },
    success:function(result)
    {
      if(trigger === "RightAnswer" || trigger === "WrongAnswer")
      {
        pScore.innerHTML = result[0];
        pTotal.innerHTML = result[1];
      }
      if(trigger === "ResetCount")
      {
        pScore.innerHTML = 0;
        pTotal.innerHTML = 0;
      }
      if(trigger === "NewCard")
      {
        pDisplay.innerHTML = result;
        AnimateFade(pDisplay);
        pFlashCardQuestion = document.getElementById("pFlashCardQuestion");
        pFlashCardQuestion.style.height = pFlashCardQuestion.scrollHeight + 'px';
        ReAssign();
      }
    },
    error:function()
    {

    }
  });
}

function ReAssign()
{
  let QuestionHolder = document.getElementById("QuestionHolder");
  if(QuestionHolder !== null) QuestionHolder.onclick = function() { FlipCard(`pFlashCard`, `QuestionHolder`, `pFlashCardAnswer`, `AnswerHolder`) };

  let AnswerHolder = document.getElementById("AnswerHolder");
  if(AnswerHolder !== null) AnswerHolder.onclick = function() { FlipCard(`pFlashCard`, `QuestionHolder`, `pFlashCardAnswer`, `AnswerHolder`) };

  let rightAnswerButton = document.getElementById("rightAnswerButton");
  let id = rightAnswerButton.dataset.i;
  if(rightAnswerButton !== null) rightAnswerButton.onclick = function() { NextCard(`right`, id); };

  let wrongAnswerButton = document.getElementById("wrongAnswerButton");
  let id2 = wrongAnswerButton.dataset.i;
  if(wrongAnswerButton !== null) wrongAnswerButton.onclick = function() { NextCard(`wrong`, id2); };

  let source = document.getElementsByClassName("source");
  for(let i = 0; i < source.length; i++)
  {
    source[i].onclick = function() { MakeCurrent(source[i]); };
  }
}

document.addEventListener("DOMContentLoaded", ReAssign);