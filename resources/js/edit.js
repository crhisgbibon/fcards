"use strict";

// Message box
const messageBox = document.getElementById("messageBox");

// Controls
const eCategory = document.getElementById("eCategory");
const eFind = document.getElementById("eFind");
const eNewCard = document.getElementById("eNewCard");

// New Card Display
const eCardDisplay = document.getElementById("eCardDisplay");

// New Card Screen
const eEditCardScreen = document.getElementById("eEditCardScreen");
const eEditCardScreenCategory = document.getElementById("eEditCardScreenCategory");

const eEditCardScreenQuestion = document.getElementById("eEditCardScreenQuestion");
const eEditCardScreenAnswer = document.getElementById("eEditCardScreenAnswer");
const eEditCardScreenLink = document.getElementById("eEditCardScreenLink");
const eEditCardScreenAdd = document.getElementById("eEditCardScreenAdd");
eEditCardScreenAdd.onclick = function() { AddNewCard() };

const eEditCardScreenClose = document.getElementById("eEditCardScreenClose");

// Assignments

// Message Box
messageBox.onclick = function(){ TogglePanel(messageBox); };
// Settings
eCategory.onchange = function(){ Filter("cardType", eCategory.options[eCategory.selectedIndex].value); };
eFind.onkeyup = function(){ FilterByText("cardType", eFind.value); };
// New Card
eNewCard.onclick = function(){ TogglePanel(eEditCardScreen); ClearEditScreen(); };
eEditCardScreenClose.onclick = function(){ TogglePanel(eEditCardScreen); };

// Variables
let timeOut = undefined;

// Startup
TogglePanel(messageBox);
TogglePanel(eEditCardScreen);

function TogglePanel(panel)
{
  if(panel.style.display == "none") panel.style.display = "";
  else panel.style.display = "none";
}

function ToggleCategory(category)
{
  let panel = document.getElementById(category + "displayCards");
  if(panel.style.display == "none")
  {
    panel.style.display = "";
    AnimateFade(panel);
  }
  else panel.style.display = "none";
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

function Filter(dataset, inputFilter)
{
  let filter, li, len, a, i;
  filter = inputFilter.toUpperCase();
  if(filter === "378462SDJKFHDSDBS8743247832" || filter === "-1") filter = "";
  li = document.getElementsByClassName(dataset);
  len = li.length;
  for(i = 0; i < len; i++)
  {
    if(filter === "")
    {
      li[i].style.display = "";
      continue;
    }
    a = li[i].dataset.search.toString();
    if(a.toUpperCase().indexOf(filter) > -1)
    {
      li[i].style.display = "";
    }
    else
    {
      li[i].style.display = "none";
    }
  }
}

function FilterByText(dataset, inputFilter)
{
  let filter, li, len, a, i;
  filter = inputFilter.toUpperCase();
  if(filter === "378462SDJKFHDSDBS8743247832" || filter === "-1") filter = "";
  li = document.getElementsByClassName(dataset);
  len = li.length;
  for(i = 0; i < len; i++)
  {
    if(filter === "")
    {
      li[i].style.display = "";
      continue;
    }
    a = li[i].dataset.name.toString();
    if(a.toUpperCase().indexOf(filter) > -1)
    {
      li[i].style.display = "";
    }
    else
    {
      li[i].style.display = "none";
    }
  }
}

function ClearEditScreen()
{
  eEditCardScreenCategory.value = "";
  eEditCardScreenQuestion.value = "";
  eEditCardScreenAnswer.value = "";
  eEditCardScreenLink.value = "";
}

function AddNewCardWithCategory(category)
{
  TogglePanel(eEditCardScreen);
  let name = document.getElementById(category + "newCategoryName").value;
  eEditCardScreenCategory.value = name;
  eEditCardScreenQuestion.value = "";
  eEditCardScreenAnswer.value = "";
  eEditCardScreenLink.value = "";
}

function SaveCardChanges(id)
{
  let deckID = document.getElementById(id + "eCardCategory").dataset.deckID;
  let deckName = document.getElementById(id + "eCardDeck").value.trim();
  let question = document.getElementById(id + "eCardQuestion").value.trim();
  let answer = document.getElementById(id + "eCardAnswer").value.trim();
  let link = document.getElementById(id + "eCardLink").value.trim();

  let data = [
    id,
    deckID,
    deckName,
    question,
    answer,
    link,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/flashcards/decks/SaveCardChanges',
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
      console.log(result);
      MessageBox("Changes saved.")
    },
    error:function(result)
    {
      console.log(result);
      MessageBox("Error.");
    }
  });
}

function DeleteCard(id)
{
  if(!confirm("Delete this card?"))
  {
    return;
  }

  let data = [
    id,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/flashcards/decks/DeleteCard',
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
      eCardDisplay.innerHTML = result;
      ReAssign();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function UpdateCategoryName(id)
{
  let newName = document.getElementById(id + "newCategoryName").value;

  let data = [
    id,
    newName
  ];

  $.ajax(
  {
    method: "POST",
    url: '/flashcards/decks/UpdateCategoryName',
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      data:data
    },
    success:function()
    {
      MessageBox("Changes saved.");
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function AddNewCard()
{
  let data = [
    eEditCardScreenCategory.value.trim(),
    eEditCardScreenQuestion.value.trim(),
    eEditCardScreenAnswer.value.trim(),
    eEditCardScreenLink.value.trim(),
  ];

  $.ajax(
  {
    method: "POST",
    url: '/flashcards/decks/AddNewCard',
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
      MessageBox("Card Added.");
      eEditCardScreenQuestion.value = "";
      eEditCardScreenAnswer.value = "";
      eEditCardScreenLink.value = "";
      eCardDisplay.innerHTML = result;
      ReAssign();
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function ClickColor(ref)
{
  let i = document.getElementById(ref + "colInput");
  i.click();
}

function SaveCol(col, stackID)
{
  let rgb = HexToRgb(col.value);
  if(col.length === 0)
  {
    MessageBox("Please select a colour.");
    return;
  }
  let show = document.getElementById(stackID + "colDiv");
  show.style.backgroundColor = "rgb(" + rgb['r'] + "," + rgb['g'] + "," + rgb['b'] + ")";

  let data = [
    stackID,
    rgb
  ];

  $.ajax(
  {
    method: "POST",
    url: '/flashcards/decks/StackCol',
    headers:
    {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data:
    {
      data:data
    },
    success:function()
    {
      MessageBox("Changes saved.");
    },
    error:function()
    {
      MessageBox("Error.");
    }
  });
}

function RgbToHex(r, g, b)
{
  return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
}

function HexToRgb(hex)
{
  let result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ?
  {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;
}

function ReAssign()
{
  let cardmodify = document.getElementsByClassName("cardmodify");
  for(let i = 0; i < cardmodify.length; i++)
  {
    let id = cardmodify[i].dataset.i;
    cardmodify[i].onclick = function() { ToggleCategory(id); };
  }

  let newcardwithcategory = document.getElementsByClassName("newcardwithcategory");
  for(let i = 0; i < newcardwithcategory.length; i++)
  {
    let id = newcardwithcategory[i].dataset.i;
    newcardwithcategory[i].onclick = function() { AddNewCardWithCategory(id); };
  }

  let updatecategoryname = document.getElementsByClassName("updatecategoryname");
  for(let i = 0; i < updatecategoryname.length; i++)
  {
    let id = updatecategoryname[i].dataset.i;
    updatecategoryname[i].onclick = function() { UpdateCategoryName(id); };
  }

  let showCols = document.getElementsByClassName("showCols");
  for(let i = 0; i < showCols.length; i++)
  {
    let id = showCols[i].dataset.i;
    showCols[i].onclick = function() { ClickColor(id); };
  }

  let hiddenCols = document.getElementsByClassName("hiddenCols");
  for(let i = 0; i < hiddenCols.length; i++)
  {
    let id = hiddenCols[i].dataset.i;
    hiddenCols[i].onchange = function() { SaveCol(hiddenCols[i], id); };
  }

  let savecardchanges = document.getElementsByClassName("savecardchanges");
  for(let i = 0; i < savecardchanges.length; i++)
  {
    let id = savecardchanges[i].dataset.i;
    savecardchanges[i].onclick = function() { SaveCardChanges(id); };
  }

  let deletecardbutton = document.getElementsByClassName("deletecardbutton");
  for(let i = 0; i < deletecardbutton.length; i++)
  {
    let id = deletecardbutton[i].dataset.i;
    deletecardbutton[i].onclick = function() { DeleteCard(id); };
  }

  let addcardwithcategory = document.getElementsByClassName("addcardwithcategory");
  for(let i = 0; i < addcardwithcategory.length; i++)
  {
    let id = addcardwithcategory[i].dataset.i;
    addcardwithcategory[i].onclick = function() { AddNewCardWithCategory(id); };
  }
}

document.addEventListener("DOMContentLoaded", ReAssign);