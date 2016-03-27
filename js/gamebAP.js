// Generated by CoffeeScript 1.10.0
(function($) {
  var gamebAP;
  gamebAP = function(element, options) {
    var closeModal, elem, getLapseInMilli, init, layout, nowInMilli, obj, showModal, storageVar, storageVarOk, storageVarTime, time;
    elem = $(element);
    layout = $('.gamebAP-bg-layout' + '.bg' + options._id);
    obj = this;
    storageVar = options.siteName + "_gamepAP" + options.id;
    storageVarOk = storageVar + 'Ok';
    storageVarTime = storageVar + 'Time';
    time = new Date();
    nowInMilli = time.getTime();
    showModal = function() {
      elem.addClass(options.effect);
      layout.show();
      elem.show();
      if (options.timeToClose !== '' && options.timeToClose !== 0) {
        setTimeout(closeModal, options.timeToClose);
      }
      localStorage.setItem(storageVarTime, nowInMilli);
    };
    closeModal = function() {
      elem.removeClass(options.effect);
      layout.hide();
      elem.hide();
    };
    layout.click(closeModal);
    getLapseInMilli = function() {
      lapse;
      var lapse;
      switch (options.lapseType) {
        case 'days':
          lapse = 1000 * 60 * 60 * 24 * parseInt(options.lapse);
          break;
        case 'hours':
          lapse = 1000 * 60 * 60 * parseInt(options.lapse);
          break;
        case 'minutes':
          lapse = 1000 * 60 * parseInt(options.lapse);
      }
      return lapse;
    };
    elem.find('span.behave-ok').click(function() {
      localStorage.setItem(storageVarOk, true);
      closeModal();
    });
    elem.find('span.behave-cancel').click(function() {
      closeModal();
    });
    elem.find('.gamebAPclose-button span').click(function() {
      closeModal();
    });
    init = function() {
      var lapseInMilli, lastShow, showOn, showingModal;
      showingModal = false;
      switch (options.show) {
        case 'always':
          showingModal = true;
          break;
        case 'once':
          if (!localStorage.getItem(storageVar)) {
            showingModal = true;
            localStorage.setItem(storageVar, true);
          }
          break;
        case 'acceptance':
          showingModal = localStorage.getItem(storageVarOk) ? !localStorage.getItem(storageVarOk) : true;
          break;
        case 'periodically':
          if (localStorage.getItem(storageVarTime)) {
            lastShow = localStorage.getItem(storageVarTime);
            lapseInMilli = getLapseInMilli();
            showOn = parseInt(lastShow) + lapseInMilli;
            if (showOn > nowInMilli) {
              showingModal = false;
            } else {
              showingModal = true;
            }
          } else {
            showingModal = true;
          }
          break;
        case 'none':
          showingModal = false;
      }
      if (showingModal) {
        setTimeout(showModal, options.timeToOpen);
      }
    };
    init();
    return {
      showModal: showModal,
      closeModal: closeModal
    };
  };
  $.fn.gamebAP = function(options, selector) {
    return {
      gamebAP: new gamebAP(this, options)
    };
  };
})(jQuery);