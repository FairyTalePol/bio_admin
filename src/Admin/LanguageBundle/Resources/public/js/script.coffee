$(document).ready () ->
  $(document).on 'click', '#add-language-btn', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'get'
      dataType: 'html'
      cache: false
      url: $(@).attr('href')
      success: (data) ->
        modal.find('.modal-title').html('Добавление нового языка')
        modal.find('.modal-body').html(data)

        modal.modal()

  $(document).on 'click', '#edit-language-btn', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'get'
      dataType: 'html'
      cache: false
      url: $(@).attr('action')
      success: (data) ->
        modal.find('.modal-title').html('Редактирование языка')
        modal.find('.modal-body').html(data)

        modal.modal()

  $(document).on 'submit', '#edit-language-form', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'post'
      dataType: 'html'
      cache: false
      url: $(@).attr('action')
      data: $(@).serialize()
      success: (data) ->
        modal.find('.modal-title').html('Редактирование языка')
        modal.find('.modal-body').html(data)

        modal.modal()

  $(document).on 'click', '#add-translation-btn', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'get'
      dataType: 'html'
      cache: false
      url: $(@).attr('href')
      success: (data) ->
        modal.find('.modal-title').html('Добавление нового перевода')
        modal.find('.modal-body').html(data)

        modal.modal()

  $(document).on 'click', '#edit-translation-btn', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'get'
      dataType: 'html'
      cache: false
      url: $(@).attr('action')
      success: (data) ->
        modal.find('.modal-title').html('Редактирование перевода')
        modal.find('.modal-body').html(data)

        modal.modal()

  $(document).on 'submit', '#edit-translation-form', (e) ->
    e.preventDefault()

    modal = $('#modal')

    $.ajax
      type: 'post'
      dataType: 'html'
      cache: false
      url: $(@).attr('action')
      data: $(@).serialize()
      success: (data) ->
        modal.find('.modal-title').html('Редактирование перевода')
        modal.find('.modal-body').html(data)

        modal.modal()

  $(document).on 'change', '#search_translations input[type=text]', (e) ->
    $('#translation_search_page').val(1)

  $(document).on 'change', '#search_translations select', (e) ->
    $('#translation_search_page').val(1)
    $('#search_translations').submit()

