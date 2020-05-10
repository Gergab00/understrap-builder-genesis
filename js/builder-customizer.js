jQuery(document).ready(function($){
  
  // Add tooltips from Tipr
  $('.has-tooltip').tipr();
  
  // Customizer BUILDER spacings
  $( ".builder_customizer_spacings_outer select" ).change(function() {
    var parent_id = "#"+$(this).closest(".builder_customizer_spacings").attr('id');
    var json_to_save = '';
    json_to_save ='{"mt":"'+$(parent_id+" .spacing_mt").val()+'","mr":"'+$(parent_id+" .spacing_mr").val()+'","mb":"'+$(parent_id+" .spacing_mb").val()+'","ml":"'+$(parent_id+" .spacing_ml").val()+'","pt":"'+$(parent_id+" .spacing_pt").val()+'","pr":"'+$(parent_id+" .spacing_pr").val()+'","pb":"'+$(parent_id+" .spacing_pb").val()+'","pl":"'+$(parent_id+" .spacing_pl").val()+'"}';
    $(parent_id+" .builder_customizer_spacings_hidden").val(json_to_save).trigger("change");
  });
  
  
});