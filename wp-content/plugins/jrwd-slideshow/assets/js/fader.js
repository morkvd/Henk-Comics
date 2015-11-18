var Fader = function(parent, element, controls, timer, interval, animation) {
    // Slide index
    this.index = 0;

    this.parent = parent;
    this.element = element;

    // Put all slides from this.element in this.slides
    this.slides = [];
    for (var i = 0; i < element.length; i++)
        this.slides.push(this.element.eq(i));

    this.controls = controls || false;
    this.timer = timer || false;

    // Default 5 seconds, or int in milliseconds
    this.intervalTime = interval || 5000;

    // Default fade, other option is slide
    this.animationType = animation || 'fade';

    this.init();
};

Fader.prototype = {
    /**
     * While set true, add timer and control elements.
     * Hides all the elements, except the first one.
     *
     * Start fading the slides.
     */
    init: function() {
        // Create timer if true
        if (this.timer) {
            this.parent.prepend( $('<div>').addClass('timer') );
            this.loopTimer();
        }

        // Controls is type (!) bool, add element
        if (this.controls === true) {
            this.parent.append (
                $('<nav>').addClass('secondary')
                    .prepend( $('<span>').addClass('next').text('Next') )
                    .prepend( $('<span>').addClass('prev').text('Prev') )
            );

            this.setControls();
        } // Controls is html element (!), only set controls
        else if (this.controls)
            this.setControls(this.controls);


        // Hide all items and show first
        if (this.animationType == 'fade') {
            this.element.hide();
            this.slides[0].show();
        } // Set width for slides container and for each slide
        else if (this.animationType == 'slide') {
            // CSS classes edits values via fader.less
            this.parent.addClass('slideAnimation');

            var width = this.parent.outerWidth();
            this.parent.find('div.slides').css({
                'width': width * this.slides.length
            });

            // Set max width using each slide
            $.each( this.slides, function(key, elem) {
                $(elem).css({
                    'width': width
                });
            });
        }

        // Start
        this.resetInterval();
    },


    /**
     * Reset the interval
     */
    resetInterval: function() {
        clearInterval(this.sliderInterval);
        this.sliderInterval = setInterval(this.nextSlide.bind(this), this.intervalTime);
    },


    /**
     * Increase index, after that fade to next slide
     */
    nextSlide: function() {
        this.index++;
        if (this.index >= this.slides.length)
            this.index = 0;

        this.animateSlides();
    },


    /**
     * Decrease index, after that fade to previous slide
     */
    previousSlide: function() {
        this.index--;
        if (this.index < 0)
            this.index = this.slides.length - 1;

        this.animateSlides();
    },


    /**
     * Fade in and -out, or slide left or right
     * Show/hide slides, reset interval and reset timer
     */
    animateSlides: function() {
        if (this.animationType == 'fade') {
            this.element.fadeOut(300);
            this.slides[this.index].delay(300).fadeIn(1000);
        } else if (this.animationType == 'slide') {
            this.parent.find('div.slides').animate({
                'marginLeft': -this.slides[this.index].position().left
            }, 500);
        }

        this.resetInterval();

        if (this.timer)
            this.loopTimer();
    },


    /**
     * Activate click actions on navigation
     *
     * @param definedControls ~ html element containing controls
     */
    setControls: function(definedControls) {
        var controls = definedControls || this.parent.find('nav.secondary');

        controls.find('span').on('click', function(event) {
            $(event.currentTarget).hasClass('next') ? this.nextSlide() : this.previousSlide();
        }.bind(this));
    },


    /**
     * Animate timer width
     *
     * @uses this.intervalTime to set animation time
     */
    loopTimer: function() {
        var timer = this.parent.find('div.timer');

        // Stay sync with controls
        timer.stop();
        timer.css('width', '0%');

        timer.animate({
            'width': '100%'
        }, this.intervalTime);
    }
};