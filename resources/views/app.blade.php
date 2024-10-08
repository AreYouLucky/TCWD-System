<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/js/app.js')
    <link rel="icon" href="./storage/logos/Starbooks-Quiz-Bee.png" type="image/icon type">
    <title>Starbooks Quiz</title>
</head>
<body class="area">
    <div id="app">
        @yield('contents')
    </div>


    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>

</body>
</html>
<style>
.overflow{
    overflow: visible;
}
:root {
    --ck-z-default: 100;
    --ck-z-panel: calc( var(--ck-z-default) + 999 );
}
.ck.ck-content  ul, 
.ck.ck-content ul li {
  list-style-type: inherit;
}

.ck.ck-content ul, ol{
  padding-left: 40px;
}
    @font-face {
        font-family: 'InterBlack';
        src: url('/fonts/Poppins-Light.ttf') format('woff');
        font-weight: normal;
        font-style: normal;
    }
    * {
        font-family: 'InterBlack', sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
        font-variation-settings:
            "thin"0;
    }

    * {
        margin: 0px;
        padding: 0px;
    }

    .white-back {
        background: rgba(255, 255, 255, 0.7) !important;
        backdrop-filter: blur(3.6px);
        -webkit-backdrop-filter: blur(2.6px);
    }


    .context {
        width: 100%;
        position: absolute;
        top: 50vh;

    }

    .context h1 {
        text-align: center;
        color: #fff;
        font-size: 50px;
    }

    .area {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1920' height='1080' preserveAspectRatio='none' viewBox='0 0 1920 1080'%3e%3cg mask='url(%26quot%3b%23SvgjsMask2154%26quot%3b)' fill='none'%3e%3crect width='1920' height='1080' x='0' y='0' fill='url(%26quot%3b%23SvgjsLinearGradient2155%26quot%3b)'%3e%3c/rect%3e%3cpath d='M1443.169%2c1108.662C1480.389%2c1109.215%2c1513.817%2c1087.525%2c1532.772%2c1055.489C1552.105%2c1022.815%2c1556.533%2c982.144%2c1537.446%2c949.326C1518.452%2c916.668%2c1480.94%2c902.274%2c1443.169%2c901.427C1403.596%2c900.54%2c1360.662%2c910.418%2c1341.272%2c944.927C1322.15%2c978.959%2c1337.439%2c1019.75%2c1358.064%2c1052.892C1377.271%2c1083.755%2c1406.821%2c1108.122%2c1443.169%2c1108.662' fill='rgba(28%2c 83%2c 142%2c 0.4)' class='triangle-float3'%3e%3c/path%3e%3cpath d='M1999.183%2c511.917C2076.336%2c508.149%2c2140.389%2c462.469%2c2182.959%2c398.013C2231.599%2c324.367%2c2279.535%2c231.946%2c2234.045%2c156.313C2189.228%2c81.8%2c2086.129%2c91.373%2c1999.183%2c92.467C1915.097%2c93.525%2c1821.131%2c92.224%2c1774.34%2c162.097C1723.525%2c237.98%2c1732.061%2c340.799%2c1781.44%2c417.625C1827.276%2c488.938%2c1914.511%2c516.053%2c1999.183%2c511.917' fill='rgba(28%2c 83%2c 142%2c 0.4)' class='triangle-float3'%3e%3c/path%3e%3cpath d='M1178.1421114548004-57.70691861219852L1120.458340064859 173.65005185301976 1351.815310530077 231.33382324296133 1409.4990819200186-0.023147222256902467z' fill='rgba(28%2c 83%2c 142%2c 0.4)' class='triangle-float1'%3e%3c/path%3e%3cpath d='M140.837%2c1050.233C244.947%2c1046.881%2c320.511%2c959.274%2c366.767%2c865.944C407.493%2c783.771%2c405.104%2c688.828%2c359.349%2c609.345C313.486%2c529.673%2c232.72%2c476.399%2c140.837%2c473.465C43.537%2c470.358%2c-51.999%2c511.812%2c-103.257%2c594.575C-157.226%2c681.716%2c-160.18%2c790.999%2c-111.779%2c881.351C-60.515%2c977.047%2c32.331%2c1053.726%2c140.837%2c1050.233' fill='rgba(28%2c 83%2c 142%2c 0.4)' class='triangle-float1'%3e%3c/path%3e%3cpath d='M1900.6022966395212 492.35257350687175L1854.8819683373629 294.31607450172197 1580.6873839807172 461.9148164575343z' fill='rgba(28%2c 83%2c 142%2c 0.4)' class='triangle-float3'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask2154'%3e%3crect width='1920' height='1080' fill='white'%3e%3c/rect%3e%3c/mask%3e%3clinearGradient x1='0%25' y1='50%25' x2='100%25' y2='50%25' gradientUnits='userSpaceOnUse' id='SvgjsLinearGradient2155'%3e%3cstop stop-color='%230e2a47' offset='0'%3e%3c/stop%3e%3cstop stop-color='rgba(51%2c 160%2c 255%2c 1)' offset='0'%3e%3c/stop%3e%3cstop stop-color='rgba(255%2c 255%2c 255%2c 1)' offset='1'%3e%3c/stop%3e%3c/linearGradient%3e%3cstyle%3e %40keyframes float1 %7b 0%25%7btransform: translate(0%2c 0)%7d 50%25%7btransform: translate(-10px%2c 0)%7d 100%25%7btransform: translate(0%2c 0)%7d %7d .triangle-float1 %7b animation: float1 5s infinite%3b %7d %40keyframes float2 %7b 0%25%7btransform: translate(0%2c 0)%7d 50%25%7btransform: translate(-5px%2c -5px)%7d 100%25%7btransform: translate(0%2c 0)%7d %7d .triangle-float2 %7b animation: float2 4s infinite%3b %7d %40keyframes float3 %7b 0%25%7btransform: translate(0%2c 0)%7d 50%25%7btransform: translate(0%2c -10px)%7d 100%25%7btransform: translate(0%2c 0)%7d %7d .triangle-float3 %7b animation: float3 6s infinite%3b %7d %3c/style%3e%3c/defs%3e%3c/svg%3e");
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 100vh;
        position: absolute;

    }

    .circles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: -1;
    }

    .circles li {
        position: absolute;
        display: block;
        list-style: none;
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.7);
        animation: animate 25s linear infinite;
        bottom: -150px;

    }

    .grow-rotate {
        display: inline-block !important; 
        transition-duration: .6s !important;
        &:hover {	
            transform: scale(1.1) !important;
        }
    }

    .circles li:nth-child(1) {
        left: 25%;
        width: 80px;
        height: 80px;
        animation-delay: 0s;
    }


    .circles li:nth-child(2) {
        left: 10%;
        width: 20px;
        height: 20px;
        animation-delay: 2s;
        animation-duration: 12s;
    }

    .circles li:nth-child(3) {
        left: 70%;
        width: 20px;
        height: 20px;
        animation-delay: 4s;
    }

    .circles li:nth-child(4) {
        left: 40%;
        width: 60px;
        height: 60px;
        animation-delay: 0s;
        animation-duration: 18s;
    }

    .circles li:nth-child(5) {
        left: 65%;
        width: 20px;
        height: 20px;
        animation-delay: 0s;
    }

    .circles li:nth-child(6) {
        left: 75%;
        width: 110px;
        height: 110px;
        animation-delay: 3s;
    }

    .circles li:nth-child(7) {
        left: 35%;
        width: 150px;
        height: 150px;
        animation-delay: 7s;
    }

    .circles li:nth-child(8) {
        left: 50%;
        width: 25px;
        height: 25px;
        animation-delay: 15s;
        animation-duration: 45s;
    }

    .circles li:nth-child(9) {
        left: 20%;
        width: 15px;
        height: 15px;
        animation-delay: 2s;
        animation-duration: 35s;
    }

    .circles li:nth-child(10) {
        left: 85%;
        width: 150px;
        height: 150px;
        animation-delay: 0s;
        animation-duration: 11s;
    }



    @keyframes animate {

        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
            border-radius: 0;
        }

        100% {
            transform: translateY(-1000px) rotate(720deg);
            opacity: 0;
            border-radius: 50%;
        }

    }

</style>
