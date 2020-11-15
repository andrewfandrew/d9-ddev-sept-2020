(function ($, Drupal, CKEDITOR) {
  /**
   * Add new custom command.
   */

  // var CKEDITOR = CKEDITOR;
  Drupal.AjaxCommands.prototype.InsertInCkeditor = function (ajax, response, status) {
    var textareaInstance = jQuery(response.selector).attr('id');
    var textData = response.args;
    localStorage.setItem(textareaInstance, textData);
  }
})(jQuery, Drupal, CKEDITOR);

jQuery( document ).ajaxStop((function() {
  var instance1 = 'edit-body-0-value';
  var instance2 = 'edit-field-job-requirements-0-value';
  var instance1Data = localStorage.getItem(instance1);
  var instance2Data = localStorage.getItem(instance2);


  console.log('instance1: '+ instance1);
  console.log('instance2: '+ instance2);
  console.log('instance1Data: '+ instance1Data);
  console.log('instance2Data: '+ instance2Data);

  if (instance1 !== undefined && instance1 != '') {
    CKEDITOR.instances[instance1].setData(instance1Data, {
      callback: function () {
        this.checkDirty(); // true
        localStorage.setItem(instance1, "");
      }
    });
  }
  if (instance2 !== undefined && instance2 != "") {
    CKEDITOR.instances[instance2].setData(instance2Data, {
      callback: function () {
        this.checkDirty(); // true
        localStorage.setItem("instance2", "");
      }
    });
  }

}));
