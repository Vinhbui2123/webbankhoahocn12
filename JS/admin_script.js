// Start 'Thông tin user'
function display_user_box(){
    var box = document.querySelector('.user-info');
    box.style = "display:block";
}

function hidden_user_box(){
    var box = document.querySelector('.user-info');
    box.style = "display:none";
}

function confirmDelete(){
    return confirm("Are you sure to delete this user?")
}
// End 'Thông tin user'


// Cập nhập file vừa up ra hiển thị luôn
var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
    URL.revokeObjectURL(output.src)
    }
};

// Start 'Thông tin khoá học'
function editInfoCourse(){
    var edit = document.getElementById('edit_info_course');
    var save = document.getElementById('save1');
    var cancel = document.getElementById('cancel1');

    edit.style.display = "none";
    save.style.display = "block";
    cancel.style.display = "block";
};

document.getElementById('save1').onclick = () => {
    var edit = document.getElementById('edit_info_course');
    var save = document.getElementById('save1');
    var cancel = document.getElementById('cancel1');

    edit.style.display = "block";
    save.style.display = "none";
    cancel.style.display = "none";
};

document.getElementById('cancel1').onclick = () => {
    var edit = document.getElementById('edit_info_course');
    var save = document.getElementById('save1');
    var cancel = document.getElementById('cancel1');

    edit.style.display = "block";
    save.style.display = "none";
    cancel.style.display = "none";
};
// End 'Thông tin khoá học'


// Start 'Thêm bài học'
// Hiển thị video khi vừa up lên luôn
document.getElementById("input").addEventListener("change", function() {
    var media = URL.createObjectURL(this.files[0]);
    var video = document.getElementById("video");
    video.src = media;
    video.style.display = "block";
  });

// Chỉnh sửa 1 video cụ thể bằng cách nhấn sửa
// const buttons = document.querySelectorAll('.update-video');
// buttons.forEach((a, index) => {
//   a.addEventListener('click', (event) => {
//     event.preventDefault();

//     // Lấy các element của Thêm bài học
//     // const lesson = document.getElementById('video');
//     // const h1 = document.getElementById('title-section1');
//     // const name_lesson = document.getElementById('name-lesson');
//     const save_change_lesson = document.getElementById('btn-save-lesson');
//     const add_lesson = document.getElementById('btn-add-lesson');
//     const cancel_change_lesson = document.getElementById('btn-cancel-change-lesson');
//     // const id_old_video = document.getElementById('id_old_video');

//     if (lesson) {
//       // Lấy các element của 1 hàng trong cùng nút 'Sửa' trong 'Các bài học' 
//       // const videoElements = document.getElementsByClassName('display-video');
//       // const videoElementName = document.getElementsByClassName('title-lesson');
//       // const videoId = document.getElementsByClassName('id-video');

//       if (videoElements[index]) {
//         h1.textContent = "Chỉnh sửa bài học";
//         add_lesson.style.display = 'none';
//         cancel_change_lesson.style.display = 'block';
//         save_change_lesson.style.display = 'block'; 
//         lesson.style.display = 'block';
//         // lesson.src = videoElements[index].src;
//         // name_lesson.value = videoElementName[index].textContent;
//         // id_old_video.value = videoId[index].textContent;
//         lesson.pause();
//       } else {
//         alert('Không tìm thấy video với chỉ số',index)
//       }
//     } else {
//       alert('Không tìm thấy video');
//     }
//   });
// });

// Nút huỷ chỉnh sửa của "Thêm bài học"
document.getElementById('btn-cancel-change-lesson').onclick = () => {
    var title = document.getElementById('name-lesson');
    var video = document.getElementById('video');
    var input_video = document.getElementById('input');

    title.value = null;
    video.src = null;
    video.style.display = 'none';
    input_video.value = null;

    document.getElementById('title-section1').textContent = "Thêm bài học";
    document.getElementById('btn-add-lesson').style.display = 'block';
    document.getElementById('btn-save-lesson').style.display = 'none';
    document.getElementById('btn-cancel-change-lesson').style.display = 'none';
};
// End 'Thêm bài học'


// Start 'Các bài học'
// Hiển thị controls của video ở 'Các bài học' khi move hoặc leave chuột 
function hello(){
    var da = document.getElementsByClassName('display-video');
    for (let i = 0; i < da.length; i++) {
        da[i].addEventListener('mousemove', (event) => {
            event.preventDefault();
            da[i].setAttribute('controls', 'true'); 
        });
    
        da[i].addEventListener('mouseleave', (event) => {
            event.preventDefault();
            da[i].removeAttribute('controls'); 
        });
    }
}
// End 'Các bài học'





