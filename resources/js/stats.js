"use strict";

// Message box
const messageBox = document.getElementById("messageBox");
// Toggles
const ToggleAll = document.getElementById("ToggleAll");
const ToggleCards = document.getElementById("ToggleCards");
const ToggleDecks = document.getElementById("ToggleDecks");
const ToggleStacks = document.getElementById("ToggleStacks");
// Panels
const AllData = document.getElementById("AllData");
const CardData = document.getElementById("CardData");
const DeckData = document.getElementById("DeckData");
const StackData = document.getElementById("StackData");
const StatSelect = document.getElementById("StatSelect");

// Assignments
// Message Box
messageBox.onclick = function(){ TogglePanel(messageBox); };
// Toggles
ToggleAll.onclick = function(){ SwitchView(0); };
ToggleCards.onclick = function(){ SwitchView(1); };
ToggleDecks.onclick = function(){ SwitchView(2); };
ToggleStacks.onclick = function(){ SwitchView(3); };
// Stat onchange
StatSelect.onchange = function() { };

// Variables
let timeOut = undefined;
const b = [ToggleAll, ToggleCards, ToggleDecks, ToggleStacks];

// Startup
TogglePanel(messageBox);
SwitchView(0);

function TogglePanel(panel)
{
  if(panel.style.display == "none") panel.style.display = "";
  else panel.style.display = "none";
}

function SwitchView(index)
{
  for(let i = 0; i < b.length; i++)
  {
    if(i === index)
    {
      b[i].style.backgroundColor = "var(--foregroundLight)";
      b[i].style.color = "var(--background)";
    }
    else
    {
      b[i].style.backgroundColor = "var(--background)";
      b[i].style.color = "var(--foreground)";
    }
  }
  LoadOptions(index);
  if(index !== 0)
  {
    StatSelect.style.display = "";
    AnimateFade(StatSelect);
  }
  else
  {
    StatSelect.style.display = "none";
  }
}

function LoadOptions(index)
{
  StatSelect.options.length = 0;
  StatSelect.dataset.type = index;
  if(index === 0) // All
  {
    let opt = document.createElement('option');
    opt.value = -1;
    opt.innerHTML = -1;
    StatSelect.appendChild(opt);
  }
  if(index === 1) // Cards
  {
    for(let i = 0; i < cards.length; i++)
    {
      let opt = document.createElement('option');
      opt.value = i;
      opt.innerHTML = cards[i]['question'];
      StatSelect.appendChild(opt);
    }
  }
  if(index === 2) // Decks
  {
    for(let i = 0; i < decks.length; i++)
    {
      let opt = document.createElement('option');
      opt.value = i;
      opt.innerHTML = decks[i]['name'];
      StatSelect.appendChild(opt);
    }
  }
  if(index === 3) // Stacks
  {
    for(let i = 0; i < stacks.length; i++)
    {
      let opt = document.createElement('option');
      opt.value = i;
      opt.innerHTML = stacks[i]['name'];
      StatSelect.appendChild(opt);
    }
  }
  if(StatSelect.options.length > 0)
  {
    StatSelect.options[0].selected = true;
    StatSelect.onchange();
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

function AnimateFromRight(panel)
{
  panel.animate(
  [
    { transform: 'translateX(+25%)', opacity: '0.0' },
    { transform: 'translateX(+20%)',  opacity: '0.25' },
    { transform: 'translateX(+15%)',  opacity: '0.50' },
    { transform: 'translateX(+10%)',  opacity: '0.75' },
    { transform: 'translateX(+5%)',  opacity: '1.0' },
    { transform: 'translateX(0%)',  opacity: '1.0' },
    { transform: 'translateX(-5%)',  opacity: '1.0' },
    { transform: 'translateX(-10%)',  opacity: '1.0' },
    { transform: 'translateX(-7.5%)',  opacity: '1.0' },
    { transform: 'translateX(-5%)',  opacity: '1.0' },
    { transform: 'translateX(-2.5%)',  opacity: '1.0' },
    { transform: 'translateX(0%)',  opacity: '1.0' },
  ],
  {
    duration: 150,
  }
 );
}

function AnimateFromLeft(panel)
{
  panel.animate(
  [
    { transform: 'translateX(-25%)', opacity: '0.0' },
    { transform: 'translateX(-20%)',  opacity: '0.25' },
    { transform: 'translateX(-15%)',  opacity: '0.50' },
    { transform: 'translateX(-10%)',  opacity: '0.75' },
    { transform: 'translateX(-5%)',  opacity: '1.0' },
    { transform: 'translateX(0%)',  opacity: '1.0' },
    { transform: 'translateX(+5%)',  opacity: '1.0' },
    { transform: 'translateX(+10%)',  opacity: '1.0' },
    { transform: 'translateX(+7.5%)',  opacity: '1.0' },
    { transform: 'translateX(+5%)',  opacity: '1.0' },
    { transform: 'translateX(+2.5%)',  opacity: '1.0' },
    { transform: 'translateX(0%)',  opacity: '1.0' },
  ],
  {
    duration: 150,
  }
 );
}

function AutoOff()
{
  messageBox.style.display = "none";
}

function ToggleCard(index)
{
  let card = document.getElementById(index + "cardHistory");
  if(card.style.display === "") card.style.display = "none";
  else card.style.display = "";
}

function ToggleDeck(index)
{
  let deck = document.getElementById(index + "deckHistory");
  if(deck.style.display === "") deck.style.display = "none";
  else deck.style.display = "";
}

function ToggleStack(index)
{
  let stack = document.getElementById(index + "stackHistory");
  if(stack.style.display === "") stack.style.display = "none";
  else stack.style.display = "";
}