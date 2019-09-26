$(function() {

  // $('.delete-button').on('click', function(e) {
  $(document).on('click', '.delete-button', function(e) {

    // aタグのリンク機能を無効化
    e.preventDefault();

    // クリックされたタスクのIDを取得
    //let id = $(this).data('id');

    // ajax処理を開始
    $.ajax({
      url: 'delete.php',
      type: 'GET',
      dataType: 'json',
      data: {
        'id': id
      }
    }).done((data) => {
      // 成功した時、該当タスクを画面から削除
      $('#task-' + id).fadeOut();
    }).fail((error) => {
      console.log(error);
      console.log('error');
    });
  })

  // 追加ボタンがクリックされた時
  $('#add-button').on('click', function(e) {

    // 送信処理を無効化
    e.preventDefault();

    // 画面に入力された文字を取得
    let text = $('#input-task').val();
    

    $.ajax({
      url: 'create.php',
      type:'POST',
      dataType: 'json',
      data: {
        // ここに送信したい値を記述
        task: text
      }
    }).done((data) => {
      console.log(data);

      // tbodyの中に、新しいタスク用にtrタグ等を作成する
      $('tbody').prepend(
        `<tr id="task-${data['id']}">` + 
          `<td>${data['name']}</td>` + 
          `<td>${data['due_date']}</td>` + 
          `<td>` + 
            `<a class="text-success" href="edit.php?id=${data['id']}">EDIT</a>` + 
          `</td>` + 
          `<td>` + 
            `<a class="text-danger delete-button" data-id=${data['id']} href="delete.php?id=${data['id']}">DELETE</a>` + 
          `</td>` + 
        `</tr>`
      );

    }).fail((error) => {
      console.log(error);
    })

  })

})
