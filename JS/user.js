function displayMyCourse() {
    const mycourse = document.getElementById('my-course');
    mycourse.classList.toggle('active-my-course')
}

function displayUserInfo(){
    const userinfo = document.getElementById('user-info');
    userinfo.classList.toggle('active-user')
}

function offVideoDetail(){
    const container_video = document.getElementById('video-main');
    container_video.classList.toggle('active-video');
    const video = document.querySelector('.video-detail');
    video.pause();
    video.currentTime = 0;
}

function onVideoDetail(){
    const container_video = document.getElementById('video-main');
    container_video.classList.toggle('active-video');
    const video = document.querySelector('.video-detail');
    video.setAttribute('autoplay',true);
    video.play();
}

function onOffQr(){
    const qr = document.getElementById('main-qr');
    qr.classList.toggle('active-qr');
}