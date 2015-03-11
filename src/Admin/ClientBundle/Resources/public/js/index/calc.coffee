$(document).ready () ->
  PRICE_FIELD_COND = 0.5
  PRICE_CONTROL_EQUIP = 150
  PRICE_MATERIAL_ACC = 3
  PRICE_AGROCONSALT = 2
  PRICE_PREMIUM = 5
  IMPL_PRICE_CONTROL_EQUIP = 600
  IMPL_PRICE_MATERIAL_ACC = 2
  IMPL_PRICE_PREMIUM = 3

  dollarSignStr = "<span class=\"dollar-sign\"> $</span> "
  dollarSignStdFieldStr = "<span class=\"dollar-sign\"> $/га</span> "
  dollarSignStdEquipStr = "<span class=\"dollar-sign\"> $/ед</span> "
  implStr = "Внедрение — $"

  # Fields
  $(".haAmount").on "keyup", ->
    numInput = $(@).val() | 0
    priceFieldCond = Math.ceil(parseFloat( numInput ) * PRICE_FIELD_COND) + ''
    priceMaterialAcc = Math.ceil(parseFloat( numInput ) * PRICE_MATERIAL_ACC) + ''
    priceAgroconsalt = Math.ceil(parseFloat( numInput ) * PRICE_AGROCONSALT) + ''
    pricePremium = Math.ceil(parseFloat( numInput ) * PRICE_PREMIUM) + ''
    implMaterial = Math.ceil(parseFloat( numInput ) * IMPL_PRICE_MATERIAL_ACC) + ''
    implPremium = Math.ceil(parseFloat( numInput ) * IMPL_PRICE_PREMIUM) + ''

    @value = @value.replace(/[^\d\.]+/g, "") if @value.match(/[^\d\.]+/g)

    if numInput < 100000
      $("._field h4").html dollarSignStr + priceFieldCond.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1'")
      $("._material h4").html dollarSignStr + priceMaterialAcc.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1'")
      $("._agroconsalt h4").html dollarSignStr + priceAgroconsalt.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1'")
      $("._premium h4").html dollarSignStr + pricePremium.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1'")

      $("._material ul").find("li:first").html implStr + implMaterial.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1'")
      $("._premium ul").find("li:first").html implStr + implPremium.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1'")

      $('.callus').css('visibility', 'hidden')

    else
      $("._field h4").html dollarSignStdFieldStr + PRICE_FIELD_COND
      $("._material h4").html dollarSignStdFieldStr + PRICE_MATERIAL_ACC
      $("._agroconsalt h4").html dollarSignStdFieldStr + PRICE_AGROCONSALT
      $("._premium h4").html dollarSignStdFieldStr + PRICE_PREMIUM

      $("._material ul").find("li:first").html implStr + IMPL_PRICE_MATERIAL_ACC + "/га"
      $("._premium ul").find("li:first").html implStr + IMPL_PRICE_PREMIUM + "/га"

      $('.callus').css('visibility', 'visible')


  # Technique
  $(".numOfEquip").on "keyup", ->
    numInput = $(@).val() | 0
    priceEquip = parseInt( numInput, 10) * PRICE_CONTROL_EQUIP + ''
    implPriceEquip = parseInt( numInput, 10) * IMPL_PRICE_CONTROL_EQUIP + ''

    @value = @value.replace(/[^\d]/g, "")  if @value.match(/[^\d]/g)

    if $(@).val() < 10000
      $("._equip h4").html dollarSignStr + priceEquip.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1'")
      $("._equip ul").find("li:first").html implStr + implPriceEquip.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1'")

      $('.callus').css('visibility', 'hidden')
    else
      $("._equip h4").html dollarSignStdEquipStr + PRICE_CONTROL_EQUIP
      $("._equip ul").find("li:first").html implStr + IMPL_PRICE_CONTROL_EQUIP + "/ед"

      $('.callus').css('visibility', 'visible')