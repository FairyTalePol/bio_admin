// Generated by CoffeeScript 1.9.2
$(document).ready(function() {
  $(document).on('click', '#add-language-btn', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'get',
      dataType: 'html',
      cache: false,
      url: $(this).attr('href'),
      success: function(data) {
        modal.find('.modal-title').html('Добавление нового языка');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('click', '#edit-language-btn', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'get',
      dataType: 'html',
      cache: false,
      url: $(this).attr('action'),
      success: function(data) {
        modal.find('.modal-title').html('Редактирование языка');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('submit', '#edit-language-form', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'post',
      dataType: 'html',
      cache: false,
      url: $(this).attr('action'),
      data: $(this).serialize(),
      success: function(data) {
        modal.find('.modal-title').html('Редактирование языка');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('click', '#add-translation-btn', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'get',
      dataType: 'html',
      cache: false,
      url: $(this).attr('href'),
      success: function(data) {
        modal.find('.modal-title').html('Добавление нового перевода');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('click', '#edit-translation-btn', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'get',
      dataType: 'html',
      cache: false,
      url: $(this).attr('action'),
      success: function(data) {
        modal.find('.modal-title').html('Редактирование перевода');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('submit', '#edit-translation-form', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'post',
      dataType: 'html',
      cache: false,
      url: $(this).attr('action'),
      data: $(this).serialize(),
      success: function(data) {
        modal.find('.modal-title').html('Редактирование перевода');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('change', '#search_translations input[type=text]', function(e) {
    return $('#translation_search_page').val(1);
  });
  return $(document).on('change', '#search_translations select', function(e) {
    $('#translation_search_page').val(1);
    return $('#search_translations').submit();
  });
});
