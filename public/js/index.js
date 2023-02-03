// 予約時間表示
const date = document.getElementById("date");
const time = document.getElementById("time");
const num_of_users = document.getElementById("num_of_users");
date.addEventListener('change', function () {
  date_view = document.getElementById("date_view");
  date_view.innerText = date.value;
});
time.addEventListener('change', function () {
  time_view = document.getElementById("time_view");
  time_view.innerText = time.value;
});
num_of_users.addEventListener('change', function () {
  num_of_users_view = document.getElementById("num_of_users_view");
  num_of_users_view.innerText = num_of_users.value + '人';
});

// ハンバーガーボタン機能