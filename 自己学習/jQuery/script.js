$(function() {

    // 新規登録モーダル
  
    $('.signup-show').click(function() {
      $('#signup-modal').fadeIn();
    });
  
    $('#close-modal').click(function() {
      $('#signup-modal').fadeOut();
    });
  
    // 言語一覧
  
    $('.lesson').hover(
      function() {
        $(this).find('.text-contents').addClass('text-active');
      },
      function() {
        $(this).find('.text-contents').removeClass('text-active');
      }
    );
  
    // アコーディオン
  
    $('.faq-list-item').click(function() {
      var $answer = $(this).find('.answer');
      if($answer.hasClass('open')) {
        $answer.removeClass('open');
        $answer.slideUp();
  
        $(this).find('span').text('+');
  
      } else {
        $answer.addClass('open');
        $answer.slideDown();
  
        $(this).find('span').text('-');
      }
    });
  });
  