let storeNumber = 86;

/**
 * 回収済みの店舗に色を付けてわかりやすくする処理
 * @type {jQuery|HTMLElement}
 */
function get_info_check (i) {
  let get_info_td = $(`#get_info\\[${i}\\]`);
  if (get_info_td.text() === '完') {
    get_info_td.css({
      'background-color': '#EF845C',
      'color': '#fff',
    });
  }
  else {
    get_info_td.css({
      'background-color': '#fff',
      'color': 'blue',
    });
  }
}

for (let i = 0; i < storeNumber; i++) {
  get_info_check(i);

  /**
   * 回収状況をクリックで切り替える処理
   */
  $(`td[id="get_info[${i}]"]`).on('click', function () {
    let number = $(this).parent().index();
    console.log(number);
    $.post('process/update_get_info.php', {
      number: number,
    }, function (data) {
       let get_info = data.get_info;
       console.log(get_info);
      if (get_info === 'complete') {
        $(`#get_info\\[${number - 1}\\]`).text('完');
      }
      else {
        $(`#get_info\\[${number - 1}\\]`).text('未');
      }
      get_info_check(number -1 );
    });
  });
}