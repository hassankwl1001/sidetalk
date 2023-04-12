
<div class="modal" id="mediaDisplayModal" role="dialog">
    <div class="modal-dialog modal-lg mediaDisplayModalDialog">
      <div class="modal-content mediaDisplayModalContent">
        <div id="modalCloseButton">
          <button type="button" class="close mediaDisplayModalCloseButton" data-dismiss="modal" style="color: white">&times;</button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-7 col-sm-2" id="showPostContent">

                </div>
                <div class="col-md-5" style="background-color: white; min-height: 600px;"> <!-- comment div -->
                   <div class="row post-author-detail-row">
                     <div class="col-md-2">
                        <figure class="image-container postOwnerImage">
                          <!-- here comes author image -->
                      </figure>
                     </div>
                     <div class="col-md-10 post-author-info">
                        <p><!-- here comes author name --></p>
                        <small><!-- here comes author current position and post time --></small>
                     </div>
                   </div>
                   <div class="post-description">
                     <p></p>
                   </div>
                   <article data-post="" class="post-article">
                    <section>
                      <div class="post-interactions">
                        <div class="interactions-amount">
                            <div class="rating-stars">
                                <ul id="stars">
                                  <li class="star 1 2 3 4 5" title="Poor" data-value="1"  data-rate="">
                                    <i class="fa fa-star fa-fw"></i>
                                  </li>
                                  <li class="star 2 3 4" title="Fair" data-value="2" data-rate="">
                                    <i class="fa fa-star fa-fw"></i>
                                  </li>
                                  <li class="star 3 4 5" title="Good" data-value="3" data-rate="">
                                    <i class="fa fa-star fa-fw"></i>
                                  </li>
                                  <li class="star 4 5" title="Excellent" data-value="4" data-rate="">
                                    <i class="fa fa-star fa-fw"></i>
                                  </li>
                                  <li class="star 5" title="WOW!!!" data-value="5" data-rate="">
                                    <i class="fa fa-star fa-fw"></i>
                                  </li>
                                </ul>
                            </div>
                            <span class="amount-info">128 Views</span>
                        </div>
                        <div class="interactions-btns">
                          <button>
                            <span class="counter ratePost"><i class=""></i></span>
                            <span class="ratePost rateCounter">Rate ({{ $post->rate_count ?? 0 }})</span>
                          </button>

                          <button>
                              <span class="counter"><img src="assets/img/Group8.png" alt=""></span>
                              <span class="reflectionCounter">Reflect ({{ $post->reflections_count ?? 0 }})</span>
                          </button>

                          <button>
                              <span class="counter"><img src="assets/img/Group5.png" alt=""></span>
                              <span>Repost (99)</span>
                          </button>

                          <button>
                              <span class="counter"><i class="fas fa-paper-plane"></i></span>
                              <span>Send</span>
                          </button>

                        </div>
                    </div>

                   <hr>

                    <div class="post-input">
                      <div class="input-section">
                          <figure class="image-container">
                              @if(auth()->user()->profile_pic != null)
                                    <img class="img-size" src="{{ $urlProfile }}/{{ auth()->user()->profile_pic }}" alt="">
                              @else
                                  <img src="{{ asset('assets/img/profile.png') }}" alt="Profile picture" />
                              @endif
                          </figure>
                          <div class="input-portion">
                              <div>
                                  <input class="form-control reflection" type="text" placeholder="Add a reflection">
                              </div>
                          </div>
                      </div>
                  </div>

                      <div class="commented-groups-modal" style="overflow-y: scroll; height:400px;">
                            <ul class="reflection-list">
                            <!-- here comes reflections -->
                          </ul>
                      <div class="load-more">
                          <a href="" data-value="0">Load more reflections</a>
                      </div>
                    </div>


                  </section>
                </article>

                </div> <!-- /comment div -->
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
