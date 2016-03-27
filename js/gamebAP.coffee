do ($ = jQuery) ->
	gamebAP = (element, options)->
		elem = $ element 
		layout = $ '.gamebAP-bg-layout' + '.bg'+options._id
		obj = this
		storageVar = options.siteName+"_gamepAP"+options.id
		storageVarOk = storageVar + 'Ok'
		storageVarTime = storageVar + 'Time'
		time = new Date()
		nowInMilli = time.getTime()

		showModal = ()->
			elem.addClass options.effect
			do layout.show
			do elem.show
			if options.timeToClose isnt '' and options.timeToClose isnt 0 then setTimeout closeModal, options.timeToClose
			localStorage.setItem storageVarTime, nowInMilli
			return

		closeModal = () ->
			elem.removeClass options.effect
			do layout.hide
			do elem.hide
			return

		layout.click closeModal;

		getLapseInMilli = ()->
			lapse
			switch options.lapseType
				when 'days' then lapse = 1000 * 60 * 60 * 24 * parseInt options.lapse
				when 'hours' then lapse = 1000 * 60 * 60 * parseInt options.lapse
				when 'minutes' then lapse = 1000 * 60 * parseInt options.lapse
			lapse

		elem.find 'span.behave-ok'
			.click ()->
				localStorage.setItem storageVarOk, true
				do closeModal
				return
		elem.find 'span.behave-cancel'
			.click ()->
				do closeModal
				return
		elem.find '.gamebAPclose-button span'
			.click ()->
				do closeModal
				return
			
		init = ()->
			showingModal = false
			switch options.show
				when 'always' then showingModal = true
				when 'once' 
					if !localStorage.getItem storageVar 
						showingModal = true 
						localStorage.setItem storageVar, true
				when 'acceptance'
					showingModal = if localStorage.getItem storageVarOk then !localStorage.getItem storageVarOk else true
				when 'periodically'
					if localStorage.getItem storageVarTime
						lastShow = localStorage.getItem storageVarTime
						lapseInMilli = do getLapseInMilli
						showOn = (parseInt(lastShow) + lapseInMilli)
						if showOn > nowInMilli then showingModal = false else showingModal = true					
					else
						showingModal = true
				when 'none'
					showingModal = false

			if showingModal then setTimeout showModal, options.timeToOpen
			return
		do init
		return {showModal, closeModal}

	$.fn.gamebAP = (options, selector) ->
		return gamebAP : new gamebAP(this, options)

	return