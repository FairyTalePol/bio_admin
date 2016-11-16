// Generated by CoffeeScript 1.11.1
$(document).ready(function() {
  $(document).on('change', '[type=file]', function(e) {
    var attachment_data, fReader, file, input;
    input = e.currentTarget;
    attachment_data = $('.attachment_data');
    file = input.files[0];
    fReader = new FileReader();
    fReader.onload = (function(theFile, that) {
      return function(e) {
        return attachment_data.val(e.target.result);
      };
    })(file, attachment_data);
    return fReader.readAsDataURL(file);
  });
  $(document).on('click', '#add-client-btn', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'get',
      dataType: 'html',
      cache: false,
      url: $(this).attr('href'),
      success: function(data) {
        modal.find('.modal-title').html('Добавление нового клиента');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('click', '#edit-client-btn', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'get',
      dataType: 'html',
      cache: false,
      url: $(this).attr('action'),
      success: function(data) {
        modal.find('.modal-title').html('Редактирование клиента');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('submit', '#edit-client-form', function(e) {
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
        modal.find('.modal-title').html('Редактирование клиента');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('click', '#add-role-btn', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'get',
      dataType: 'html',
      cache: false,
      url: $(this).attr('href'),
      success: function(data) {
        modal.find('.modal-title').html('Добавление новой роли БД');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('click', '#edit-role-btn', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'get',
      dataType: 'html',
      cache: false,
      url: $(this).attr('action'),
      success: function(data) {
        modal.find('.modal-title').html('Редактирование роли БД');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('submit', '#edit-role-form', function(e) {
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
        modal.find('.modal-title').html('Редактирование роли БД');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('click', '#add-vermin-btn', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'get',
      dataType: 'html',
      cache: false,
      url: $(this).attr('href'),
      success: function(data) {
        modal.find('.modal-title').html('Добавление');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  $(document).on('click', '#edit-vermin-btn', function(e) {
    var modal;
    e.preventDefault();
    modal = $('#modal');
    return $.ajax({
      type: 'get',
      dataType: 'html',
      cache: false,
      url: $(this).attr('action'),
      success: function(data) {
        modal.find('.modal-title').html('Редактирование');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
  return $(document).on('submit', '#edit-vermin-btn', function(e) {
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
        modal.find('.modal-title').html('Редактирование');
        modal.find('.modal-body').html(data);
        return modal.modal();
      }
    });
  });
});
