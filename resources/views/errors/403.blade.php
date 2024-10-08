<div id="main-wrapper">
  <div id="box">

    <div id="top-background-bars-wrapper" class="background-bars-wrapper">
      <div class="bar1 background-bar"></div>
      <div class="bar2 background-bar"></div>
      <div class="bar3 background-bar"></div>
      <div class="bar4 background-bar"></div>
      <div class="bar5 background-bar"></div>
      <div class="bar6 background-bar"></div>
      <div class="bar7 background-bar"></div>
      <div class="bar8 background-bar"></div>
      <div class="bar9 background-bar"></div>
      <div class="bar10 background-bar"></div>
    </div>

    <div id="bottom-background-bars-wrapper" class="background-bars-wrapper">
      <div class="bar1 background-bar"></div>
      <div class="bar2 background-bar"></div>
      <div class="bar3 background-bar"></div>
      <div class="bar4 background-bar"></div>
      <div class="bar5 background-bar"></div>
      <div class="bar6 background-bar"></div>
      <div class="bar7 background-bar"></div>
      <div class="bar8 background-bar"></div>
      <div class="bar9 background-bar"></div>
      <div class="bar10 background-bar"></div>
    </div>

    <svg id="skull" viewbox="0 0 500 565" xmlns="http://www.w3.org/2000/svg">
          <defs>

            <filter id="softGlow" height="300%" width="400%" x="-75%" y="-75%">

              <feMorphology operator="dilate" radius="5" in="SourceAlpha" result="thicken" />
              <feGaussianBlur in="thicken" stdDeviation="5" result="blurred" />
              <feFlood flood-color="rgb(255,0,0)" result="glowColor" />
              <feComposite in="glowColor" in2="blurred" operator="in" result="softGlow_colored" />

              <feMerge>
                <feMergeNode in="softGlow_colored"/>
                <feMergeNode in="SourceGraphic"/>
              </feMerge>

            </filter>

          </defs>

          <g transform="translate(50 330)">
          <path fill="white" stroke="black" stroke-width="20" filter="url(#softGlow)"
                                             d="
                                             M 0 0
                                             a 215 215 0 1 1 400 0
                                             v 50
                                             h 20
                                             v 90
                                             l -20 20
                                             h -80
                                             v -30
                                             v 70
                                             h -240
                                             v -70
                                             v 30
                                             h -80
                                             l -20 -20
                                             v -90
                                             h 20
                                             z"/>
          <circle id="left-eye" fill="red" stroke="black" stroke-width="20"
                                                          cx="100" cy="0" r="50" />
          <use href="#left-eye" x="200" y="0" />

          <path id="nose" fill="none" stroke="black" stroke-width="20"
                                                     d="
                                                     M 200 50
                                                     v 40" />
          <use id="tooth" href="#nose" x="-90" y="100" />
          <use href="#tooth" x="40" y="0" />
          <use href="#tooth" x="90" y="0" />
          <use href="#tooth" x="140" y="0" />
          <use href="#tooth" x="180" y="0" />
          </g>
        </svg>
    <div class="warning-msg">ACCESS DENIED <div class="login"><a href="{{Route('login')}}"> Redirect to Login Page</a></div> </div>
  </div>
</div>
<style>
html,
body {
  height: 100%;
  width: 100%;
  background-color: black;
}
#main-wrapper {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
#box {
  border-color: red;
  border-style: solid;
  border-width: 1px;
  position: relative;
  background-color: red;
  width: 80%;
  height: 80%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
#skull {
  padding: 2vh;
  padding-bottom: 0;
  position: relative;
  z-index: 3;
}
.warning-msg {
  position: relative;
  padding: 1.5vw;
  color: white;
  font-weight: bold;
  font-size: 5vw;
  z-index: 4;
  font-family: 'VT323', monospace;
  letter-spacing: 0.5em;
}
.background-bars-wrapper {
  position: absolute;
  display: flex;
  width: 100%;
  height: 50%;
}
#bottom-background-bars-wrapper {
  align-items: flex-end;
  bottom: 0;
  left: 0;
  z-index: 1;
}
#top-background-bars-wrapper {
  align-items: flex-start;
  top: 0;
  left: 0;
  z-index: 2;
}
.bar1 {
  animation-delay: 0.1s;
}
.bar2 {
  animation-delay: 0.2s;
}
.bar3 {
  animation-delay: 0.3s;
}
.bar4 {
  animation-delay: 0.4s;
}
.bar5 {
  animation-delay: 0.5s;
}
.bar6 {
  animation-delay: 0.5s;
}
.bar7 {
  animation-delay: 0.4s;
}
.bar8 {
  animation-delay: 0.3s;
}
.bar9 {
  animation-delay: 0.2s;
}
.bar10 {
  animation-delay: 0.1s;
}
.background-bar {
  animation-timing-function: ease;
  animation-duration: 0.4s;
  animation-name: bar;
  animation-iteration-count: infinite;
  animation-direction: alternate;
  height: 50%;
  width: 10%;
  margin-left: 1px;
  margin-right: 1px;
  background-color: black;
}
.login a{
    color:white;
    text-decoration: none;
    font-size: 13px;
    letter-spacing: 0em;
}
.login{
    background-color: rgb(255, 0, 55);
    padding: 10px;
    width: 40%;
    border-radius: 20px;
    text-align: center;
    margin-top: 20px;
    margin: auto;
}
@-webkit-keyframes bar {
  from {
    height: 50%;
  }
  to {
    height: 90%;
  }
}
@keyframes bar {
  from {
    height: 50%;
  }
  to {
    height: 90%;
  }
}
</style>