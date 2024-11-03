@extends('layouts.app')

@section('content')
    <main class="position-relative container justify-content-center py-4">
        <div id="notification-center"></div>
        <div class="row align-items-center  justify-content-center  mb-3" id="gallery-header">
            <div class=" col-lg-12  col-12 d-none d-lg-block">
                <div class="banner">
                    <h4>Photo Gallery</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="row" id="photos">
                    
                  
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button class="btn btn-primary load-photos">Load more photos</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endsection
    <script>
    $(document).ready(function() {
        let pageId = 2;

        $('.load-photos').on('click', function(e) {
            e.preventDefault();

            $.post('/gallery', {
                'page': pageId
            }, function(response) {
                // update the page id
                pageId++;

                if (response.data.last_page < pageId) {
                    $('.load-photos').fadeOut();
                }

                response.data.forEach((item, index) => {
                    const card = generatePhotoCard(item, index);
                    $('#photos').append(card);
                });

                // notify the user
                showNotification(pageId, 'New photos have been loaded!');

                $('html, body').animate({
                    scrollTop: '+=600px'
                }, 800);
            });
        });

        function generatePhotoCard(item, index) {
            const userId = 0;
            const likedClass = item.likes.some(like => like.id === userId) ? 'liked' : '';
            const cardColor = (index % 3 === 0) ? 'blue' : (index % 2 === 0) ? 'aqua' : 'dark-blue';

            return `
                    <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                        <div class="card photo">
                            <div class="card-body p-0">
                                <div class="image" id="photo-${


            item.id}" style="background-image: url(https://static.habboon.pw/camera/${item.static_name});">
                                    <div class="actions">
                                        <a href="#" class="like-photo" data-id="${
            item.id}">
                                            <i class="fas fa-heart ${likedClass}"></i>&nbsp;
                                            <span class="like-count-${item.id}">${item.likes.length}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer ${




            cardColor}">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <div class="me">
                                            <img src="https://imager.habboon.pw/?figure=${


            item.user.look}&direction=3&head_direction=3&gesture=sml&headonly=1" alt="${item.user.username}" loading="lazy">
                                        </div>
                                    </div>

                                    <div class="col-9">
                                        <p>
                                            <a href="#">${




            item.user.username}</a>
                                            <br/>
                                            <span style="color: #fff;">${
            moment.unix(item.timestamp).format('DD/MM/YYYY')}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`





            ;
        }

        $(document).on('click', '.like-photo', function(e) {
            e.preventDefault();

            const photoId = $(this).data('id');
            const urlTemplate = "#/gallery/PHOTO_ID/toggle-like";
            const url = urlTemplate.replace('PHOTO_ID', photoId);

            $.post(url, {
                'photoId': photoId
            }, function(response) {
                const id = response.id;

                // update the like count
                $('.like-count-' + photoId).text(response.likes);

                if (response.status === 'liked') {
                    $('#photo-' + photoId + ' .fas').addClass('liked');
                } else {
                    $('#photo-' + photoId + ' .fas').removeClass('liked');
                }

                // notify the user
                showNotification(id, 'You have ' + response.status + ' this photo!');
            }).fail(function() {
                showNotification(1, 'You must be logged in to do this!');
            });
        });

        function showNotification(id, message) {
            $('#notification-center').prepend('<div class="alert alert-' + id + '">' + message + '</div>');

            setTimeout(function() {
                $('.alert-' + id).fadeOut();
            }, 3500);
        }
    });
    </script>
</body>
</html>
