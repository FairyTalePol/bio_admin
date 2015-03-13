$(document).ready () ->
  $(document).on 'click', '#add-client-btn', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'get'
      dataType: 'html'
      cache: false
      url: $(@).attr('href')
      success: (data) ->
        modal.find('.modal-title').html('Добавление нового клиента')
        modal.find('.modal-body').html(data)

        modal.modal()

  $(document).on 'click', '#edit-client-btn', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'get'
      dataType: 'html'
      cache: false
      url: $(@).attr('action')
      success: (data) ->
        modal.find('.modal-title').html('Редактирование клиента')
        modal.find('.modal-body').html(data)

        modal.modal()

  $(document).on 'submit', '#edit-client-form', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'post'
      dataType: 'html'
      cache: false
      url: $(@).attr('action')
      data: $(@).serialize()
      success: (data) ->
        modal.find('.modal-title').html('Редактирование клиента')
        modal.find('.modal-body').html(data)

        modal.modal()

  $(document).on 'click', '#add-role-btn', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'get'
      dataType: 'html'
      cache: false
      url: $(@).attr('href')
      success: (data) ->
        modal.find('.modal-title').html('Добавление новой роли БД')
        modal.find('.modal-body').html(data)

        modal.modal()

  $(document).on 'click', '#edit-role-btn', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'get'
      dataType: 'html'
      cache: false
      url: $(@).attr('action')
      success: (data) ->
        modal.find('.modal-title').html('Редактирование роли БД')
        modal.find('.modal-body').html(data)

        modal.modal()

  $(document).on 'submit', '#edit-role-form', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'post'
      dataType: 'html'
      cache: false
      url: $(@).attr('action')
      data: $(@).serialize()
      success: (data) ->
        modal.find('.modal-title').html('Редактирование роли БД')
        modal.find('.modal-body').html(data)

        modal.modal()