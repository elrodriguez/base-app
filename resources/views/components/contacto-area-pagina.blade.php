<div>
    <section class="contact-section">
        <div class="pd_top_90"></div>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 mb-5 mb-lg-5 mb-xl-0">
              <div class="contact_form_box_all type_one">
                <div class="contact_form_box_inner">
                  <div class="contact_form_shortcode">
                    <form
                      id="contact-form"
                      method="post"
                      action="contact.php"
                      role="form"
                    >
                      <div class="messages"></div>
    
                      <div class="controls">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label> Nombre Completo<br /></label>
                              <input
                                type="text"
                                name="name"
                                placeholder="Nombre Completo *"
                                required="required"
                                data-error="Nombre Completo"
                              />
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label> Teléfono<br /></label>
                              <input
                                type="text"
                                name="name"
                                placeholder="Teléfono *"
                                required="required"
                                data-error="Teléfono"
                              />
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label> E-mail<br /></label>
                              <input
                                type="text"
                                name="email"
                                required="required"
                                placeholder="E-mail *"
                                data-error="Enter E-mail Id"
                              />
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label> Tu Mensaje<br /></label>
                              <textarea
                                name="message"
                                placeholder="Tu Mensaje"
                                rows="3"
                                required="required"
                                data-error="Tu Mensaje"
                              ></textarea>
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
    
                          <div class="col-sm-12">
                            <div class="form-group mg_top apbtn">
                              <button class="theme_btn" type="submit">
                                Enviar Ahora
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--
            <div class="col-xl-6 col-lg-6 pd_left_30">
              <div class="title_all_box style_one dark_color">
                <div class="title_sections left">
                  <div class="before_title">Contacta con</div>
                  <h2>nuestro equipo de expertos</h2>
                  <p>
                    Envíe un mensaje a través del formulario dado. Si su consulta es
                    urgente, utilice los datos de contacto a continuación.
                  </p>
                </div>
              </div>
    
              <div class="contact_box_content style_one">
                <div class="contact_box_inner icon_yes">
                  <div class="icon_bx">
                    <span class="icon-placeholder"></span>
                  </div>
                  <div class="contnet">
                    <h3>Dirección</h3>
                    <p>Providencia 1208 Of. 1603 - Santiago.</p>
                  </div>
                </div>
              </div>
              <div class="pd_bottom_15"></div>
              <div class="contact_box_content style_one">
                <div class="contact_box_inner icon_yes">
                  <div class="icon_bx">
                    <span class="icon-phone-call"></span>
                  </div>
                  <div class="contnet">
                    <h3>Consultas generales</h3>
                    <p>Teléfono: +98 060 712 34 &amp; E-mail: contacto@kentha.cl</p>
                  </div>
                </div>
              </div>
              <div class="pd_bottom_15"></div>
              <div class="contact_box_content style_one">
                <div class="contact_box_inner icon_yes">
                  <div class="icon_bx">
                    <span class="fa fa-clock-o"></span>
                  </div>
                  <div class="contnet">
                    <h3>Horario de atennción</h3>
                    <p>Lun - Sab: 09.00 am a 06.00 pm (Domingos: Closed)</p>
                  </div>
                </div>
              </div>
              <div class="pd_bottom_40"></div>
              <div class="social_media_v_one style_two">
                <ul>
                  <li>
                    <a href="#">
                      <span class="fa fa-facebook"></span>
                      <small>facebook</small>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="fa fa-twitter"></span>
                      <small>twitter</small>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="fa fa-skype"></span>
                      <small>skype</small>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="fa fa-instagram"></span>
                      <small>instagram</small>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            -->
            <div class="col-xl-6 col-lg-6 pd_left_30">
              <div class="title_all_box style_one dark_color">
                <div class="title_sections left">
                  <div class="before_title">{{ $data[0]->item->content }}</div>
                  <h2>{{ $data[1]->item->content }}</h2>
                  <p>
                    {{ $data[2]->item->content }}
                  </p>
                </div>
              </div>
    
              <div class="contact_box_content style_one">
                <div class="contact_box_inner icon_yes">
                  <div class="icon_bx">
                    <span class="icon-placeholder"></span>
                  </div>
                  <div class="contnet">
                    <h3>Dirección</h3>
                    <p>{{ $data[3]->item->content }}</p>
                  </div>
                </div>
              </div>
              <div class="pd_bottom_15"></div>
              <div class="contact_box_content style_one">
                <div class="contact_box_inner icon_yes">
                  <div class="icon_bx">
                    <span class="icon-phone-call"></span>
                  </div>
                  <div class="contnet">
                    <h3>Consultas generales</h3>
                    <p>Teléfono: {{ $data[4]->item->content }} <br>
                      E-mail: {{ $data[5]->item->content }}</p>
                  </div>
                </div>
              </div>
              <div class="pd_bottom_15"></div>
              <div class="contact_box_content style_one">
                <div class="contact_box_inner icon_yes">
                  <div class="icon_bx">
                    <span class="fa fa-clock-o"></span>
                  </div>
                  <div class="contnet">
                    <h3>Horario de atennción</h3>
                    <p>{{ $data[6]->item->content }}</p>
                  </div>
                </div>
              </div>
              <div class="pd_bottom_40"></div>
              <div class="social_media_v_one style_two">
                <ul>
                  <li>
                    <a href="{{ $data[7]->item->content }}">
                      <span class="fa fa-facebook"></span>
                      <small>facebook</small>
                    </a>
                  </li>
                  <li>
                    <a href="{{ $data[8]->item->content }}">
                      <span class="fa fa-instagram"></span>
                      <small>instagram</small>
                    </a>
                  </li>
                  <li>
                    <a href="{{ $data[9]->item->content }}">
                      <span class="fa fa-twitter"></span>
                      <small>twitter</small>
                    </a>
                  </li>
                  <li>
                    <a href="{{ $data[10]->item->content }}">
                      <span class="fa fa-linkedin"></span>
                      <small>Linkedin</small>
                    </a>
                  </li>
                  <li>
                    <a href="{{ $data[11]->item->content }}">
                      <span class="fa fa-youtube-play"></span>
                      <small>Youtube</small>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="pd_top_70"></div>
    </section>
</div>