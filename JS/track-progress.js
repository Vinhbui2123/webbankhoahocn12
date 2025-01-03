document.addEventListener("DOMContentLoaded", function () {
  const video = document.querySelector("video.video-item")
  if (!video) return

  let lastUpdateTime = 0
  const UPDATE_INTERVAL = 5 // seconds

  video.addEventListener("timeupdate", function () {
    const currentTime = Math.floor(video.currentTime)
    if (currentTime - lastUpdateTime >= UPDATE_INTERVAL) {
      updateProgress(currentTime)
      lastUpdateTime = currentTime
    }
  })

  video.addEventListener("ended", function () {
    markVideoComplete()
  })
})

function updateProgress(currentTime) {
  const params = new URLSearchParams(window.location.search)
  const videoId = params.get("video_id")
  const courseId = params.get("course_id")

  fetch("update_progress.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `video_id=${videoId}&course_id=${courseId}&current_time=${currentTime}`,
  })
}

function markVideoComplete() {
  const params = new URLSearchParams(window.location.search)
  const videoId = params.get("video_id")
  const courseId = params.get("course_id")

  fetch("update_progress.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `video_id=${videoId}&course_id=${courseId}&completed=1`,
  })
}
