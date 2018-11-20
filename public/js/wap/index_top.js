window.onscroll = function () {
    var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    if (scrollTop > 3) {
        document.getElementsByClassName('mjd-header')[0].style.backgroundColor = "#ff8c00";
    }
    if (scrollTop > 100) {
        document.getElementsByClassName('m-back-to-top')[0].style.bottom = "80px";
    }
    if (scrollTop < 100) {
        document.getElementsByClassName('m-back-to-top')[0].style.bottom = "-200px";
    }
    if (scrollTop < 3 || scrollTop == 0) {
        document.getElementsByClassName('mjd-header')[0].style.backgroundColor = "transparent";
    }
}
const ScrollTop2 = (number = 0, time) => {
    if (!time) {
        document.body.scrollTop = document.documentElement.scrollTop = number;
        return number;
    }
    const spacingTime = 20; // 设置循环的间隔时间  值越小消耗性能越高
    let spacingInex = time / spacingTime; // 计算循环的次数
    let nowTop = document.body.scrollTop + document.documentElement.scrollTop; // 获取当前滚动条位置
    let everTop = (number - nowTop) / spacingInex; // 计算每次滑动的距离
    let scrollTimer = setInterval(() => {
        if (spacingInex > 0) {
            spacingInex--;
            ScrollTop2(nowTop += everTop);
        } else {
            clearInterval(scrollTimer); // 清除计时器
        }
    }, spacingTime);
};
document.getElementById('msShortcutMenu').onclick = function () {
    window.location.href = '/my';
};
document.getElementById('msCancelBtn').onclick = function () {
    window.location.href = '/category';
};