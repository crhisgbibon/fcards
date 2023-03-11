"use strict";

// Message box
const messageBox = document.getElementById("messageBox");
// Controls
const Find = document.getElementById("Find");
const New = document.getElementById("New");
// Display
const Display = document.getElementById("Display");
// New Stack Display
const NewEntry = document.getElementById("NewEntry");
// New Stack Data
const NewEntryName = document.getElementById("NewEntryName");
const SelectNew = document.getElementById("SelectNew");
// Buttons
const AddNew = document.getElementById("AddNew");
const CloseNewEntry = document.getElementById("CloseNewEntry");
// Edit Stack Display
const EditEntry = document.getElementById("EditEntry");
// Edit Stack Data
const EditEntryName = document.getElementById("EditEntryName");
const SelectEdit = document.getElementById("SelectEdit");
// Buttons
const SubmitEdit = document.getElementById("SubmitEdit");
const CloseEdit = document.getElementById("CloseEdit");

// Assignments
// Message Box
messageBox.onclick = function(){ TogglePanel(messageBox); };
// Settings
Find.onkeyup = function(){ Filter("stackType", Find.value); };
// New Stack
AddNew.onclick = function(){ AddNewItem(); };
SubmitEdit.onclick = function(){ EditExistingStack(); };
New.onclick = function(){ 
  if(EditEntry.style.display === "") TogglePanel(EditEntry); 
  TogglePanel(NewEntry); 
  ClearEditScreen2(); };
CloseNewEntry.onclick = function(){ TogglePanel(NewEntry); };
// Edit Stack
CloseEdit.onclick = function(){ TogglePanel(EditEntry); };

// Startup
TogglePanel(messageBox);
TogglePanel(NewEntry);
TogglePanel(EditEntry);

let timeOut = undefined;

function TogglePanel(panel)
{
  if(panel.style.display == "none") panel.style.display = "";
  else panel.style.display = "none";
}

function TogglePanel2(ref)
{
  let panel = document.getElementById(ref);
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

function ClearEditScreen()
{
  NewEntryName.value = "";
  for(let i = 0; i < SelectNew.length; i++)
  {
    SelectNew[i].selected = false;
  }
}

function ClearEditScreen2()
{
  EditEntryName.value = "";
  for(let i = 0; i < SelectEdit.length; i++)
  {
    SelectEdit[i].selected = false;
  }
}

function EditStackScreen(id)
{
  ClearEditScreen();
  let index = document.getElementById(id + "Meta").dataset.id;
  let name = document.getElementById(id + "Meta").dataset.search;
  let decks = JSON.parse(document.getElementById(id + "Meta").dataset.decks);
  EditEntryName.value = name;
  EditEntryName.dataset.id = index;
  for(let i = 0; i < SelectEdit.length; i++)
  {
    for(let d = 0; d < decks.length; d++)
    {
      if(decks[d] === SelectEdit[i].value)
      {
        SelectEdit[i].selected = true;
        break;
      }
    }
  }
  TogglePanel(EditEntry);
}

function Delete(id)
{
  if(!confirm("Delete this stack?"))
  {
    return;
  }

  let data = [
    id,
  ];

  $.ajax(
  {
    method: "POST",
    url: '/stacks/DeleteStack',
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
      Display.innerHTML = result;
      ReAssign();
    },
    error:function()
    {

    }
  });
}

function UpdateStackName(id)
{
  let newName = document.getElementById(id + "NewName").value;

  let data = [
    id,
    newName
  ];

  $.ajax(
  {
    method: "POST",
    url: '/stacks/UpdateStackName',
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
      Display.innerHTML = result;
      ReAssign();
    },
    error:function()
    {

    }
  });
}

function AddNewItem()
{
  let selected = [];
  for(let i = 0; i < SelectNew.length; i++)
  {
    if(SelectNew[i].selected) selected.push(SelectNew[i].value);
  }

  let data = [
    NewEntryName.value.trim(),
    selected
  ];

  $.ajax(
  {
    method: "POST",
    url: '/stacks/AddNewStack',
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
      Display.innerHTML = result;
      TogglePanel(NewEntry);
      ReAssign();
    },
    error:function()
    {

    }
  });
}

function EditExistingStack()
{
  let selected = [];
  for(let i = 0; i < SelectEdit.length; i++)
  {
    if(SelectEdit[i].selected) selected.push(SelectEdit[i].value);
  }

  let data = [
    EditEntryName.dataset.id,
    EditEntryName.value,
    selected
  ];

  $.ajax(
  {
    method: "POST",
    url: '/stacks/EditExistingStack',
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
      Display.innerHTML = result;
      TogglePanel(EditEntry);
      ReAssign();
    },
    error:function()
    {

    }
  });
}

function ReAssign()
{
  let togglestack = document.getElementsByClassName("togglestack");
  for(let i = 0; i < togglestack.length; i++)
  {
    let id = togglestack[i].dataset.i;
    togglestack[i].onclick = function() { TogglePanel2(id + "displayStack") };
  }

  let updatestackname = document.getElementsByClassName("updatestackname");
  for(let i = 0; i < updatestackname.length; i++)
  {
    let id = updatestackname[i].dataset.i;
    updatestackname[i].onclick = function() { UpdateStackName(id) };
  }

  let editstackscreen = document.getElementsByClassName("editstackscreen");
  for(let i = 0; i < editstackscreen.length; i++)
  {
    let id = editstackscreen[i].dataset.i;
    editstackscreen[i].onclick = function() { EditStackScreen(id) };
  }

  let deletestack = document.getElementsByClassName("deletestack");
  for(let i = 0; i < deletestack.length; i++)
  {
    let id = deletestack[i].dataset.i;
    deletestack[i].onclick = function() { Delete(id) };
  }
}

document.addEventListener("DOMContentLoaded", ReAssign);