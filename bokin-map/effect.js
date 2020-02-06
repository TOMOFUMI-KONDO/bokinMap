let storeNumber = 86;

for (let i = 0; i < storeNumber; i++) {
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
    });
  });
}