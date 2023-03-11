@vite(['resources/js/play.js'])

<x-app-layout>

  <style>
    :root{
      --background: var(--backgroundLight);
      --foreground: var(--foregroundLight);

      --buttonBackground: var(--buttonBackgroundLight);
      --buttonBorder: var(--buttonBorderLight);

      --buttonBackgroundLight: rgba(240, 240, 240, 1);
      --buttonBackgroundHover: rgba(150, 150, 150, 1);
      --buttonBorderLight: rgba(75,75,75,1);

      --foregroundLight: rgba(50, 50, 50, 1);
      --backgroundLight: rgba(255, 255, 255, 1);

      --green: rgba(125, 200, 125, 1);
      --red: rgba(200, 125, 125, 1);
    }

    body{
      max-width: 100%;
      overflow-x: hidden;
    }

    #pDisplay{
      width: 100%;
      height: calc(var(--vh) * 75);
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-content: flex-start;
      align-items: center;
    }

    #pFlashCard{
      position: relative;
      background-color: var(--background);
      color: var(--foreground);
      display: flex;
      justify-content: center;
      align-items: center;
      width: 90%;
      height: 90%;
      max-width: 600px;
      max-height: 600px;
      margin: 0;
      padding: 0;
      overflow: hidden;
      border: 1px solid var(--foreground);
    }

    #QuestionHolder{
      height:100%;
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    #pFlashCardCategory{
      min-height: 10%;
      max-height: 100%;
      width: 100%;
      overflow-y: auto;
      text-align: center;
      float: left;
      border: none;
      resize: none;
      outline: none;
      cursor: default;
      -webkit-user-select: none;
      -webkit-touch-callout: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -o-user-select: none;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
    }

    #pFlashCardQuestion{
      min-height: 10%;
      max-height: 100%;
      width: 100%;
      overflow-y: auto;
      text-align: center;
      float: left;
      border: none;
      resize: none;
      outline: none;
      cursor: default;
      -webkit-user-select: none;
      -webkit-touch-callout: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -o-user-select: none;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
    }

    #pFlashCardQuestion:focus{
      outline: none;
      -webkit-user-select: none;
      -webkit-touch-callout: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -o-user-select: none;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
    }

    #pFlashCardAnswer{
      height:100%;
      width: 100%;
      display: block;
      flex-direction: column;
      float: left;
    }

    #AnswerHolder{
      height:75%;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #pFlashCardAnswerContents{
      min-height: 10%;
      max-height: 100%;
      width: 100%;
      display: block;
      text-align: center;
      border: none;
      resize: none;
      outline: none;
      cursor: default;
      -webkit-user-select: none;
      -webkit-touch-callout: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -o-user-select: none;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
    }

    #pFlashCardAnswerContents:focus{
      outline: none;
      -webkit-user-select: none;
      -webkit-touch-callout: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -o-user-select: none;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
    }

    .pControls{
      height: 25%;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: row;
      border-top: 1px solid var(--foreground);
    }

    .pControlDiv{
      height: 100%;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .pButton{
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 50%;
      height: 50px;
      width: 50px;
      border: 1px solid var(--foreground);
    }

    .pButton:active{
      transform: scale(110%, 110%);
    }

    #rightAnswerButton{
      background-color: var(--green);
    }

    #wrongAnswerButton{
      background-color: var(--red);
    }

    #playSelectMenu{
      z-index: 1;
      position: fixed;
      background-color: var(--background);
      width: 100%;
      height: calc(var(--vh) * 77);
      top: calc(var(--vh) * 22.5);
      margin: 0;
      padding: 0;
      overflow-y: auto;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      flex-direction: column;
    }

    .source{
      cursor:pointer;
    }

    #pPlayButton{
      height: 60%;
      padding: 4px;
      border-radius: 25%;
    }

    #pReset{
      height: 60%;
      padding: 4px;
      border-radius: 25%;
    }
    
  </style>

  <x-slot name="appTitle">
    {{ __('Play') }}
  </x-slot>

  <x-slot name="appName">
    {{ __('Play') }}
  </x-slot>

  <div id="messageBoxHolder" style="display:none;"><div id="messageBox"></div></div>

  <x-playControls :decks="$decks" :stacks="$stacks" :card="$card" :currentscore="$currentscore" :currenttotal="$currenttotal"></x-playControls>

</x-app-layout>