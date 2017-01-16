/**
 * Created by 朝宏 on 2016/9/29.
 */
window.onload = function () {
    function $(id) {
        return document.getElementById(id);
    }
    //动态生成li
    var len = $("slider_box").children.length-2;
    //alert(len);
    var ul = document.createElement("ul");
    $("shop_left").appendChild(ul);
    ul.setAttribute("class","number");
    for(var i = 0; i < len; i++) {
        var li = document.createElement("li");
        ul.appendChild(li);
        li.innerHTML = i + 1;
    }
    ul.children[0].className = "current";

    //封装运动函数
    function animate(offset) {
        var newLeft = parseInt($("slider_box").style.left) + offset;
        $("slider_box").style.left =  newLeft + "px";
        if(newLeft > -730) {
            $("slider_box").style.left = -4380 + "px";
        } else if ( newLeft < -4380) {
            $("slider_box").style.left = -730 + "px";
        }
    }

    //点击调用函数
    $("arrow_l").onclick = function () {
        animate(-730);
    }
    $("arrow_r").onclick = function () {
        animate(730);
    }

    //点击下方小圆点实现跳转
    var liS = $("shop_left").children[2].children;
    var index = 1;
    for(var i = 0; i < len; i++) {
        liS[i].index = i;
        liS[i].onclick = function () {
            for(var j = 0; j < len; j++) {
                liS[j].className = "";
            }
            this.className = "current";
            var clickIndex = this.index +1;
            var offset = 730 * (index - clickIndex);
            animate(offset);
            index = clickIndex;
        }
    }
    //清除所有li的样式，给当前加上current
    function liShow() {
        for(var i=0; i<liS.length; i++) {
            if(liS[i].className == "current") {
                liS[i].className = "";
            }
        }
        liS[index-1].className = "current";
    }
    $("arrow_l").onclick = function() {
        index -= 1;
        if(index<1) {
            index = 6;
        }
        liShow();
        animate(730);
    }
    $("arrow_r").onclick = function() {
        index += 1;
        if(index>6) {
            index = 1;
        }
        liShow();
        animate(-730);
    }

    var timer = null;
    function play() {
        stop();		//使用定时器先清除定时器
        timer = setInterval(function () {
            $("arrow_r").onclick();
        },2000);
    }

    //当鼠标移入盒子中时停止定时器
    function stop() {
        clearInterval(timer);
    }
    $("shop_left").onmouseover = stop;
    $("shop_left").onmouseout = play;
    play();
}