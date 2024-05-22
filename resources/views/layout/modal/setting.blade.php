<div class="modal fade" id="SettingsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-vertical right-side modal-dialog-scrollable">
      <div class="modal-content">
        <div class="px-xl-4 modal-header">
          <h5 class="modal-title">Theme Setting</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="px-xl-4 modal-body custom_scroll">

          <div class="card fieldset border border-primary p-3 setting-theme mb-4">
            <span class="fieldset-tile text-primary bg-card">Color Settings</span>
            <ul class="list-unstyled d-flex choose-skin mb-0">
              <li data-theme="black">
                <div class="black"></div>
              </li>
              <li data-theme="indigo">
                <div class="indigo"></div>
              </li>
              <li data-theme="blue">
                <div class="blue"></div>
              </li>
              <li data-theme="cyan">
                <div class="cyan"></div>
              </li>
              <li data-theme="green">
                <div class="green"></div>
              </li>
              <li data-theme="orange">
                <div class="orange"></div>
              </li>
              <li data-theme="blush">
                <div class="blush"></div>
              </li>
              <li data-theme="red">
                <div class="red"></div>
              </li>
              <li data-theme="dynamic">
                <div class="dynamic"><i class="fa fa-paint-brush"></i></div>
              </li>
            </ul>

            <div class="card fieldset border border-primary p-3 dt-setting mt-4">
              <span class="fieldset-tile text-primary bg-card">Dynamic Color Settings</span>
              <div class="row g-3">
                <div class="col-7">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <button id="primaryColorPicker" class="btn bg-primary avatar xs me-2"></button>
                      <label>Primary Color</label>
                    </li>
                    <li>
                      <button id="secondaryColorPicker" class="btn bg-secondary avatar xs me-2"></button>
                      <label>Secondary Color</label>
                    </li>
                    <li>
                      <button id="BodyColorPicker" class="btn btn-outline-secondary bg-body avatar xs me-2"></button>
                      <label>Site Background</label>
                    </li>
                    <li>
                      <button id="CardColorPicker" class="btn btn-outline-secondary bg-card avatar xs me-2"></button>
                      <label>Widget Background</label>
                    </li>
                    <li>
                      <button id="BorderColorPicker" class="btn btn-outline-secondary bg-card avatar xs me-2"></button>
                      <label>Border Color</label>
                    </li>
                  </ul>
                </div>
                <div class="col-5">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <button id="chartColorPicker1" class="btn chart-color1 avatar xs me-2"></button>
                      <label>Chart Color 1</label>
                    </li>
                    <li>
                      <button id="chartColorPicker2" class="btn chart-color2 avatar xs me-2"></button>
                      <label>Chart Color 2</label>
                    </li>
                    <li>
                      <button id="chartColorPicker3" class="btn chart-color3 avatar xs me-2"></button>
                      <label>Chart Color 3</label>
                    </li>
                    <li>
                      <button id="chartColorPicker4" class="btn chart-color4 avatar xs me-2"></button>
                      <label>Chart Color 4</label>
                    </li>
                    <li>
                      <button id="chartColorPicker5" class="btn chart-color5 avatar xs me-2"></button>
                      <label>Chart Color 5</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="card fieldset border setting-mode mb-4">
            <span class="fieldset-tile bg-card">Light/Dark & Contrast Layout</span>
            <div class="c_radio d-flex text-center">
              <label class="m-1 theme-switch" for="theme-switch">
                <input type="checkbox" id="theme-switch" />
                <span class="card p-2">
                  <img class="img-fluid" src="{{ asset('style/assets/img/dark-version.svg') }}" alt="Dark Mode" />
                </span>
              </label>
              <label class="m-1 theme-dark" for="theme-dark">
                <input type="checkbox" id="theme-dark" />
                <span class="card p-2">
                  <img class="img-fluid" src="{{ asset('style/assets/img/dark-theme.svg') }}" alt="Theme Dark Mode" />
                </span>
              </label>
              <label class="m-1 theme-high-contrast" for="theme-high-contrast">
                <input type="checkbox" id="theme-high-contrast" />
                <span class="card p-2">
                  <img class="img-fluid" src="{{ asset('style/assets/img/high-version.svg') }}" alt="High Contrast" />
                </span>
              </label>
              <label class="m-1 theme-rtl" for="theme-rtl">
                <input type="checkbox" id="theme-rtl" />
                <span class="card p-2">
                  <img class="img-fluid" src="{{ asset('style/assets/img/rtl-version.svg') }}" alt="RTL Mode!" />
                </span>
              </label>
            </div>
          </div>

          <div class="card fieldset border setting-font">
            <span class="fieldset-tile bg-card">Google Font Settings</span>
            <div class="c_radio d-flex text-center font_setting">
              <label class="m-1" for="font-opensans">
                <input type="radio" name="font" id="font-opensans" value="font-opensans" />
                <span class="card p-2">
                  <img class="img-fluid" src="{{ asset('style/assets/img/font-opensans.svg') }}" alt="Dark Mode" />
                </span>
              </label>
              <label class="m-1" for="font-quicksand">
                <input type="radio" name="font" id="font-quicksand" value="font-quicksand" />
                <span class="card p-2">
                  <img class="img-fluid" src="{{ asset('style/assets/img/font-quicksand.svg') }}" alt="Dark Mode" />
                </span>
              </label>
              <label class="m-1" for="font-nunito">
                <input type="radio" name="font" id="font-nunito" value="font-nunito" checked="" />
                <span class="card p-2">
                  <img class="img-fluid" src="{{ asset('style/assets/img/font-nunito.svg') }}" alt="Dark Mode" />
                </span>
              </label>
              <label class="m-1" for="font-raleway">
                <input type="radio" name="font" id="font-raleway" value="font-raleway" />
                <span class="card p-2">
                  <img class="img-fluid" src="{{ asset('style/assets/img/font-raleway.svg') }}" alt="Dark Mode" />
                </span>
              </label>
            </div>
          </div>

          <div class="m-1 p-3 bg-body rounded-4 mb-4">
            <p>Dynamic Font Settings</p>
            <div class="mb-2">
              <label class="form-label small text-muted mb-0">Enter font URL</label>
              <input id="font_url" type="text" class="form-control" placeholder="http://fonts.cdnfonts.com/css/vonfont">
            </div>
            <div class="mb-3">
              <label class="form-label small text-muted mb-0">Enter font family name</label>
              <input id="font_family" type="text" class="form-control" placeholder="vonfont">
            </div>
            <button id="font_apply" type="submit" class="btn btn-primary">Save Changes</button>
            <button id="font_cancel" type="submit" class="btn btn-secondary">Clear Changes</button>
          </div>

          <div class="setting-more mb-4">
          <h6 class="card-title">More Setting</h6>
            <ul class="list-group list-group-flush list-group-custom fs-6">

              <li class="list-group-item">
                <div class="form-check form-switch h-menu-switch mb-1">
                  <input class="form-check-input" type="checkbox" id="h_menu">
                  <label class="form-check-label" for="h_menu">Horizontal Menu Version</label>
                </div>
              </li>

              <li class="list-group-item">
                <div class="form-check form-switch pageheader-switch mb-1">
                  <input class="form-check-input" type="checkbox" id="PageHeader" checked>
                  <label class="form-check-label" for="PageHeader">Page Header Fix</label>
                </div>
              </li>

              <li class="list-group-item">
                <div class="form-check form-switch pageheader-dark-switch mb-1">
                  <input class="form-check-input" type="checkbox" id="PageHeader_dark">
                  <label class="form-check-label" for="PageHeader_dark">Page Header Dark Mode</label>
                </div>
              </li>

              <li class="list-group-item">
                <div class="form-check form-switch radius-switch mb-1">
                  <input class="form-check-input" type="checkbox" id="BorderRadius">
                  <label class="form-check-label" for="BorderRadius">Border Radius none</label>
                </div>
              </li>

              <li class="list-group-item">
                <div class="form-check form-switch sidebar-v2 mb-1">
                  <input class="form-check-input" type="checkbox" id="sidebar_v2">
                  <label class="form-check-label" for="sidebar_v2">Sidebar Version 2</label>
                </div>
              </li>

              <li class="list-group-item">
                <div class="form-check form-switch sidebardark-switch mb-1">
                  <input class="form-check-input" type="checkbox" id="SidebarDark">
                  <label class="form-check-label" for="SidebarDark">Enable Dark! ( Sidebar )</label>
                </div>
              </li>

              <li class="list-group-item setting-img">
                <div class="form-check form-switch imagebg-switch mb-1">
                  <input class="form-check-input" type="checkbox" id="CheckImage">
                  <label class="form-check-label" for="CheckImage">Background Image (Sidebar)</label>
                </div>
                <div class="bg-images">
                  <ul class="list-unstyled d-flex">
                    <li class="sidebar-img-1 me-1 sidebar-img-active"><a class="rounded sidebar-img" id="img-1" href="#"><img src="{{ asset('style/assets/img/sidebar-bg/sidebar-1.jpg') }}" alt="" /></a></li>
                    <li class="sidebar-img-2 me-1"><a class="rounded sidebar-img" id="img-2" href="#"><img src="{{ asset('style/assets/img/sidebar-bg/sidebar-2.jpg') }}" alt="" /></a></li>
                    <li class="sidebar-img-3 me-1"><a class="rounded sidebar-img" id="img-3" href="#"><img src="{{ asset('style/assets/img/sidebar-bg/sidebar-3.jpg') }}" alt="" /></a></li>
                    <li class="sidebar-img-4 me-1"><a class="rounded sidebar-img" id="img-4" href="#"><img src="{{ asset('style/assets/img/sidebar-bg/sidebar-4.jpg') }}" alt="" /></a></li>
                    <li class="sidebar-img-5 me-1"><a class="rounded sidebar-img" id="img-5" href="#"><img src="{{ asset('style/assets/img/sidebar-bg/sidebar-5.jpg') }}" alt="" /></a></li>
                  </ul>
                </div>
              </li>

              <li class="list-group-item">
                <div class="form-check form-switch fluid-switch mb-1">
                  <input class="form-check-input" type="checkbox" id="fluidLayout" checked="">
                  <label class="form-check-label" for="fluidLayout">Container Fluid</label>
                </div>
              </li>

              <li class="list-group-item">
                <div class="form-check form-switch shadow-switch mb-1">
                  <input class="form-check-input" type="checkbox" id="card_shadow">
                  <label class="form-check-label" for="card_shadow">Card Box-Shadow</label>
                </div>
              </li>
            </ul>
          </div>

          <div class="mb-4">
            <a class="btn lift  btn-outline-secondary" href="marketing/index.html">Marketing page</a>
            <a class="btn lift  btn-outline-secondary" href="onepgae-uikit/onepage.html">Landing page</a>
            <a class="btn lift  btn-outline-secondary" href="onepgae-uikit/index.html">One page Ui Kit Elements</a>
          </div>
        </div>
        <div class="px-xl-4 modal-footer d-flex justify-content-start text-center">
          <button type="button" class="btn flex-fill btn-primary lift">Save Changes</button>
          <button type="button" class="btn flex-fill btn-white border lift" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
