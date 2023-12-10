(function ($) {
    'use strict';

    var rating = {};
    mkdf.modules.rating = rating;

    rating.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitCommentRating();
    }

    function mkdfInitCommentRating() {
        var ratingHolder = $('.mkdf-comment-form-rating');

        var addActive = function (stars, ratingValue) {
            for (var i = 0; i < stars.length; i++) {
                var star = stars[i];
                if (i < ratingValue) {
                    $(star).addClass('active');
                } else {
                    $(star).removeClass('active');
                }
            }
        };

        ratingHolder.each(function () {
            var thisHolder = $(this),
                ratingInput = thisHolder.find('.mkdf-rating'),
                ratingValue = ratingInput.val(),
                stars = thisHolder.find('.mkdf-star-rating');

            addActive(stars, ratingValue);

            stars.on('click', function () {
                ratingInput.val($(this).data('value')).trigger('change');
            });

            ratingInput.on('change', function () {
                ratingValue = ratingInput.val();
                addActive(stars, ratingValue);
            });
        });
    }

})(jQuery);