
<div class="modal fade" id="RecentChat" tabindex="-1">
    <div class="modal-dialog modal-dialog-vertical modal-dialog-scrollable">
      <div class="modal-content">
        <div class="d-flex align-items-start">
          <div class="nav flex-column nav-pills p-3 h-100">
            <a class="nav-link rounded-circle p-1 mb-2 active" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
              <img class="avatar sm rounded-circle border" src="{{ asset('style/assets/img/xs/avatar1.jpg') }}" alt="avatar">
            </a>
            <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-2" title="">
              <img class="avatar sm rounded-circle border" src="{{ asset('style/assets/img/xs/avatar2.jpg') }}" alt="avatar">
            </a>
            <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-3" title="">
              <img class="avatar sm rounded-circle border" src="{{ asset('style/assets/img/xs/avatar3.jpg') }}" alt="avatar">
            </a>
            <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-2" title="">
              <img class="avatar sm rounded-circle border" src="{{ asset('style/assets/img/xs/avatar4.jpg') }}" alt="avatar">
            </a>
            <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-5" title="">
              <img class="avatar sm rounded-circle border" src="{{ asset('style/assets/img/xs/avatar5.jpg') }}" alt="avatar">
            </a>
            <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
              <img class="avatar sm rounded-circle border" src="{{ asset('style/assets/img/xs/avatar6.jpg') }}" alt="avatar">
            </a>
            <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-7" title="">
              <img class="avatar sm rounded-circle border" src="{{ asset('style/assets/img/xs/avatar7.jpg') }}" alt="avatar">
            </a>
            <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-3" title="">
              <img class="avatar sm rounded-circle border" src="{{ asset('style/assets/img/xs/avatar8.jpg') }}" alt="avatar">
            </a>
            <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-3" title="">
              <img class="avatar sm rounded-circle border" src="{{ asset('style/assets/img/xs/avatar9.jpg') }}" alt="avatar">
            </a>
            <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
              <img class="avatar sm rounded-circle border" src="{{ asset('style/assets/img/xs/avatar10.jpg') }}" alt="avatar">
            </a>
            <a class="nav-link rounded-circle p-1 mb-2" href="javascript:void(0);" data-bs-toggle="pill" data-bs-target="#c-user-1" title="">
              <img class="avatar sm rounded-circle border" src="{{ asset('style/assets/img/xs/avatar5.jpg') }}" alt="avatar">
            </a>
          </div>
          <div class="tab-content shadow-sm">
            <div class="tab-pane fade show active" id="c-user-1" role="tabpanel">
              <div class="card">

                <div class="card-header border-bottom py-3">
                  <div class="d-flex">
                    <a href="javascript:void(0);" title="">
                      <img class="avatar rounded-circle" src="{{ asset('style/assets/img/xs/avatar1.jpg') }}" alt="avatar">
                    </a>
                    <div class="ms-3">
                      <h6 class="mb-0">Orlando Lentz</h6>
                      <small class="text-muted">Last seen: 2 hours ago</small>
                    </div>
                  </div>
                  <div class="dropdown morphing scale-left">
                    <a class="nav-link p-2 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-camera"></i></a>
                    <a class="nav-link p-2 me-1 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-video-camera"></i></a>
                    <a class="nav-link py-2 px-3 text-muted d-inline-block d-xl-none" data-bs-dismiss="modal" aria-label="Close" href="#"><i class="fa fa-close"></i></a>
                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                    <ul class="dropdown-menu shadow border-0 p-2">
                      <li><a class="dropdown-item" href="#">File Info</a></li>
                      <li><a class="dropdown-item" href="#">Copy to</a></li>
                      <li><a class="dropdown-item" href="#">Move to</a></li>
                      <li><a class="dropdown-item" href="#">Rename</a></li>
                      <li><a class="dropdown-item" href="#">Block</a></li>
                      <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                  </div>
                </div>

                <div class="card-body custom_scroll" style="height: calc(100vh - 141px);">
                  <ul class="list-unstyled chat-history flex-grow-1">

                    <li class="mb-3 d-flex flex-row align-items-end">
                      <div class="max-width-70">
                        <div class="user-info mb-1">
                          <img class="avatar xs rounded-circle me-1" src="{{ asset('style/assets/img/xs/avatar1.jpg') }}" alt="avatar">
                          <span class="text-muted small">10:10 AM, Today</span>
                        </div>
                        <div class="card p-3">
                          <div class="message"> Hi Aiden, how are you?</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row-reverse align-items-end">
                      <div class="max-width-70 text-end">
                        <div class="user-info mb-1">
                          <span class="text-muted small">10:12 AM, Today</span>
                        </div>
                        <div class="card border-0 p-3 bg-primary text-light">
                          <div class="message">Are we meeting today?</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row align-items-end">
                      <div class="max-width-70">
                        <div class="user-info mb-1">
                          <img class="avatar xs rounded-circle me-1" src="{{ asset('style/assets/img/xs/avatar1.jpg') }}" alt="avatar">
                          <span class="text-muted small">10:10 AM, Today</span>
                        </div>
                        <div class="card p-3">
                          <div class="message"> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row align-items-end">
                      <div class="max-width-70">
                        <div class="user-info mb-1">
                          <img class="avatar xs rounded-circle me-1" src="{{ asset('style/assets/img/xs/avatar1.jpg') }}" alt="avatar">
                          <span class="text-muted small">10:10 AM, Today</span>
                        </div>
                        <div class="card p-3">
                          <div class="message"> Contrary to popular belief, Lorem Ipsum is not simply random text.</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row-reverse align-items-end">
                      <div class="max-width-70 text-end">
                        <div class="user-info mb-1">
                          <span class="text-muted small">10:12 AM, Today</span>
                        </div>
                        <div class="card border-0 p-3 bg-primary text-light">
                          <div class="message">Yes, Orlando Allredy done <br> There are many variations of passages of Lorem Ipsum available</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row align-items-end">
                      <div class="max-width-70">
                        <div class="user-info mb-1">
                          <img class="avatar xs rounded-circle me-1" src="{{ asset('style/assets/img/xs/avatar1.jpg') }}" alt="avatar">
                          <span class="text-muted small">10:10 AM, Today</span>
                        </div>
                        <div class="card p-3">
                          <div class="message">
                            <p>Please find attached images</p>
                            <img class="w120 img-thumbnail" src="{{ asset('style/assets/img/gallery/3.jpg') }}" alt="">
                            <img class="w120 img-thumbnail" src="{{ asset('style/assets/img/gallery/4.jpg') }}" alt="">
                          </div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row-reverse align-items-end">
                      <div class="max-width-70 text-end">
                        <div class="user-info mb-1">
                          <span class="text-muted small">10:12 AM, Today</span>
                        </div>
                        <div class="card border-0 p-3 bg-primary text-light">
                          <div class="message">Okay, will check and let you know.</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="card-footer border-top bg-transparent py-3 px-4">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter text here...">
                    <button class="btn btn-primary" type="button">Send</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade show active" id="c-user-2" role="tabpanel">
              <div class="card">

                <div class="card-header border-bottom py-3">
                  <div class="d-flex">
                    <a href="javascript:void(0);" title="">
                      <img class="avatar rounded-circle" src="{{ asset('style/assets/img/xs/avatar2.jpg') }}" alt="avatar">
                    </a>
                    <div class="ms-3">
                      <h6 class="mb-0">Orlando Lentz</h6>
                      <small class="text-muted">Last seen: 2 hours ago</small>
                    </div>
                  </div>
                  <div class="dropdown morphing scale-left">
                    <a class="nav-link p-2 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-camera"></i></a>
                    <a class="nav-link p-2 me-1 text-secondary d-none d-xl-inline-block" href="javascript:void(0);"><i class="fa fa-video-camera"></i></a>
                    <a class="nav-link py-2 px-3 text-muted d-inline-block d-xl-none" data-bs-dismiss="modal" aria-label="Close" href="#"><i class="fa fa-close"></i></a>
                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                    <ul class="dropdown-menu shadow border-0 p-2">
                      <li><a class="dropdown-item" href="#">File Info</a></li>
                      <li><a class="dropdown-item" href="#">Copy to</a></li>
                      <li><a class="dropdown-item" href="#">Move to</a></li>
                      <li><a class="dropdown-item" href="#">Rename</a></li>
                      <li><a class="dropdown-item" href="#">Block</a></li>
                      <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                  </div>
                </div>

                <div class="card-body custom_scroll" style="height: calc(100vh - 141px);">
                  <ul class="list-unstyled chat-history flex-grow-1">

                    <li class="mb-3 d-flex flex-row-reverse align-items-end">
                      <div class="max-width-70 text-end">
                        <div class="user-info mb-1">
                          <span class="text-muted small">10:12 AM, Today</span>
                        </div>
                        <div class="card border-0 p-3 bg-primary text-light">
                          <div class="message">Are we meeting today?</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row align-items-end">
                      <div class="max-width-70">
                        <div class="user-info mb-1">
                          <img class="avatar xs rounded-circle me-1" src="{{ asset('style/assets/img/xs/avatar2.jpg') }}" alt="avatar">
                          <span class="text-muted small">10:10 AM, Today</span>
                        </div>
                        <div class="card p-3">
                          <div class="message"> Hi Aiden, how are you?</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row-reverse align-items-end">
                      <div class="max-width-70 text-end">
                        <div class="user-info mb-1">
                          <span class="text-muted small">10:12 AM, Today</span>
                        </div>
                        <div class="card border-0 p-3 bg-primary text-light">
                          <div class="message">Yes, Orlando Allredy done <br> There are many variations of passages of Lorem Ipsum available</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row align-items-end">
                      <div class="max-width-70">
                        <div class="user-info mb-1">
                          <img class="avatar xs rounded-circle me-1" src="{{ asset('style/assets/img/xs/avatar2.jpg') }}" alt="avatar">
                          <span class="text-muted small">10:10 AM, Today</span>
                        </div>
                        <div class="card p-3">
                          <div class="message">
                            <p>Please find attached images</p>
                            <img class="w120 img-thumbnail" src="{{ asset('style/assets/img/gallery/1.jpg') }}" alt="">
                            <img class="w120 img-thumbnail" src="{{ asset('style/assets/img/gallery/2.jpg') }}" alt="">
                          </div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row-reverse align-items-end">
                      <div class="max-width-70 text-end">
                        <div class="user-info mb-1">
                          <span class="text-muted small">10:12 AM, Today</span>
                        </div>
                        <div class="card border-0 p-3 bg-primary text-light">
                          <div class="message">Okay, will check and let you know.</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row align-items-end">
                      <div class="max-width-70">
                        <div class="user-info mb-1">
                          <img class="avatar xs rounded-circle me-1" src="{{ asset('style/assets/img/xs/avatar2.jpg') }}" alt="avatar">
                          <span class="text-muted small">10:10 AM, Today</span>
                        </div>
                        <div class="card p-3">
                          <div class="message"> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>

                    <li class="mb-3 d-flex flex-row align-items-end">
                      <div class="max-width-70">
                        <div class="user-info mb-1">
                          <img class="avatar xs rounded-circle me-1" src="{{ asset('style/assets/img/xs/avatar2.jpg') }}" alt="avatar">
                          <span class="text-muted small">10:10 AM, Today</span>
                        </div>
                        <div class="card p-3">
                          <div class="message"> Contrary to popular belief, Lorem Ipsum is not simply random text.</div>
                        </div>
                      </div>

                      <div class="btn-group">
                        <a href="#" class="nav-link py-2 px-3 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu rounded-4 border-0 shadow">
                          <li><a class="dropdown-item" href="#">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Share</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="card-footer border-top bg-transparent py-3 px-4">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter text here...">
                    <button class="btn btn-primary" type="button">Send</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
