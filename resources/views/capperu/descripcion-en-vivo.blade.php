@extends('layouts.capperu')

@section('content')
    <!-- preloader area start -->
    <x-capperu.preloader-area></x-capperu.preloader-area>
    <!-- preloader area end -->

    <x-capperu.body-overlay-area></x-capperu.body-overlay-area>

    <!-- search popup area start -->
    <x-capperu.search-popup-area></x-capperu.search-popup-area>
    <!-- //. search Popup -->

    <!-- Encabezado inicio -->
    <x-capperu.header-area></x-capperu.header-area>
    <!-- Encabezado fin -->


    <!-- Banner Area Start-->
    <section class="banner-area style-3"
        style="padding: 40px; background-image: url({{ asset('themes/capperu/assets/img/banner/bg-2.jpg') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 align-self-center">
                    <div class="banner-inner text-center">
                        <h4 style="color: #fff;">
                            {{ $course->description }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!-- courses-details Area Start-->
    <section class="courses-details-area pd-top-100 pd-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-course-wrap mb-0">
                                <div class="thumb">
                                    <span class="play-btn"><i class="fa fa-play"></i></span>
                                    <img src="{{ $course->image }}" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h5>{{ $course->description }}</h5>
                                    <p>{{ $course->description }}</p>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <a href="">
                                                <span style="color:orange;">
                                                    Sector:
                                                </span>
                                                <b>Empresarial</b>
                                            </a>
                                        </div>
                                        <div class="user-rating">
                                            <span style="color:orange;">
                                                <i>Modalidad:</i>
                                            </span>
                                            <b>En Vivo</b>
                                        </div>
                                        <div class="user-rating">
                                            <span style="color:orange;">
                                                <i>Programa:</i>
                                            </span>
                                            <b>Diplomado</b>
                                        </div>
                                        <div class="user-rating">
                                            <span style="color:orange;">
                                                <i>Inicio:</i>
                                            </span>
                                            <b>12/12/2023</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="">
                                <img style="100%;" src="{{ asset('themes/capperu/assets/img/convenios/logoUnhv.png') }}"
                                    alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="course-tab nav nav-pills pd-top-100">
                            <li class="nav-item">
                                <button class="nav-link active" id="pill-1" data-bs-toggle="pill"
                                    data-bs-target="#pills-01" type="button" role="tab" aria-controls="pills-01"
                                    aria-selected="true">
                                    Presentación
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="pill-2" data-bs-toggle="pill" data-bs-target="#pills-02"
                                    type="button" role="tab" aria-controls="pills-02" aria-selected="false">
                                    Beneficios
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="pill-3" data-bs-toggle="pill" data-bs-target="#pills-03"
                                    type="button" role="tab" aria-controls="pills-03" aria-selected="false">
                                    Plana Docente
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="pill-4" data-bs-toggle="pill" data-bs-target="#pills-04"
                                    type="button" role="tab" aria-controls="pills-04" aria-selected="false">
                                    Preguntas Frecuentes
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-01" role="tabpanel" aria-labelledby="pill-1">
                                <div class="overview-area">
                                    <p>
                                        El presente programa está orientado a brindar a los participanteslas herramientas
                                        necesarias para comprender el funcionamientodel
                                        sistema penal acusatorio y desarrollar habilidades paracomprender y ejercer con
                                        éxito las normas en materia Penal ,Procesal Penal y Técnicas de Litigación en el
                                        Proceso Penal Peruanoen litigar.
                                    </p>
                                    <p>
                                        El diplomado tendrá como ponentes a los más reconocidos jueces,fiscales, docentes y
                                        especialistas en materia de derecho penal.Durante el desarrollo del diplomado, se
                                        abordarán temas claves enDerecho Penal, Nuevo Código Procesal Penal y Técnicas
                                        deLitigación Oral.
                                    </p>
                                    <p>
                                        El Centro de Actualización Profesional CAP - PERÚ y la Facultad deDerecho y Ciencias
                                        Políticas de la Universidad Nacional HermilioValdizán (licenciada por Sunedu)
                                        expedirá el diploma con valoruniversitario por 384 horas académicas (24 créditos),
                                        válido paratoda convocatoria pública o privada a nivel nacional.
                                    </p>
                                    <div class="bg-gray">
                                        <h6>Dirigido a:
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul>
                                                    <li>
                                                        <i class="fa fa-check"></i>
                                                        Estudiantes de los últimos ciclos de lacarrera de Derecho.
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-check"></i>
                                                        Bachilleres o egresados con tituloprofesinal en Derecho.
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-check"></i>
                                                        Jueces u Fiscales de todos los nivelesjerárquicos.
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-check"></i>
                                                        Abogados, defensores públicos yasesores.
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-check"></i>
                                                        Asistentes de Función Fiscal, Secretarios ytécnicos judiciales.
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-check"></i>
                                                        Ejecutivos policiales, peritos ycriminalísitica.
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-02" role="tabpanel" aria-labelledby="pill-2">
                                <div class="overview-area">
                                    <div class="row">
                                        <div class="col-md-6" style="padding: 10px;">
                                            <h6>Docentes Especializados:</h6>
                                            <p>Clases en vivo dictadas pormagistrados especializados en
                                                la materia de derecho.
                                            </p>
                                        </div>
                                        <div class="col-md-6" style="padding: 10px;">
                                            <h6>Acreditación:</h6>
                                            <p>Diplomado de especializaciónemitido por 384 horas académicas
                                                (24 créditos por la UniversidadNacional Hermilio Valdizán).
                                            </p>
                                        </div>
                                        <div class="col-md-6" style="padding: 10px;">
                                            <h6>Certificación:</h6>
                                            <p>
                                                Diplomado especializado con valoruniversitario certificado por el Centro de
                                                Actualización Profesional y Consultoría SAC, con el aval académico de la
                                                Facultad
                                                de Derecho y Ciencias Políticas de laUniversidad Nacional Hermilio Valdizán
                                                (UNHEVAL);
                                                el cual se leremitirá en FORMATO FÍSICO.
                                            </p>
                                        </div>
                                        <div class="col-md-6" style="padding: 10px;">
                                            <h6>Modalidad de Estudios Mixta:</h6>
                                            <p>
                                                - Modalidad en vivo porplataforma virtualGoogle Meet.
                                                Se dictará todos los viernes de 6:30 p.m. a9:30 p.m
                                            </p>
                                            <p>
                                                - Modalidad E - Learningacceso al CAMPUSVIRTUAL CAP - PERÚ las24 horas del
                                                día.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-03" role="tabpanel" aria-labelledby="pill-3">
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-md-2">
                                        <a href="{{ route('web_perfil_docente', 1) }}">
                                            <!-- poner el id del teacher teacher_id -->
                                            <img style="width: 90px; margin-bottom: 10px; margin-left: 10px;"
                                                src="{{ asset('themes/capperu/assets/img/author/01.png') }}"
                                                alt="img">
                                        </a>
                                    </div>
                                    <div class="col-md-10">
                                        <h6>DR. FRANK ALMANZA ALTAMIRANO</h6>
                                        <ul>
                                            <li>
                                                Fiscal Superior Penal de Lima. Docente UPSMP, ESAN y AMAG.
                                            </li>
                                            <li>
                                                Autor diversion libros en su especialidad.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-md-2">
                                        <a href="{{ route('web_perfil_docente', 1) }}">
                                            <img style="width: 90px; margin-bottom: 10px; margin-left: 10px;"
                                                src="{{ asset('themes/capperu/assets/img/author/01.png') }}"
                                                alt="img">
                                        </a>
                                    </div>
                                    <div class="col-md-10">
                                        <h6>DR. FRANK ALMANZA ALTAMIRANO</h6>
                                        <ul>
                                            <li>
                                                Juez Titular del Tecer Juzgado de Investigación Preparatoria de la Corte
                                                Superior de Justicia de La Libertad.
                                            </li>
                                            <li>
                                                Fiscal Provincial Titular de la Fiscalia Provincial de La Libertad
                                                especializada en Delitos de Corrupción de La Libertad.
                                            </li>
                                            <li>
                                                Bachilleres o egresados con tituloprofesinal en Derecho.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-md-2">
                                        <a href="{{ route('web_perfil_docente', 1) }}">
                                            <img style="width: 90px; margin-bottom: 10px; margin-left: 10px;"
                                                src="{{ asset('themes/capperu/assets/img/author/01.png') }}"
                                                alt="img">
                                        </a>
                                    </div>
                                    <div class="col-md-10">
                                        <h6>DR. FRANK ALMANZA ALTAMIRANO</h6>
                                        <ul>
                                            <li>
                                                Estudiantes de los últimos ciclos de lacarrera de Derecho.
                                            </li>
                                            <li>
                                                Bachilleres o egresados con tituloprofesinal en Derecho.
                                            </li>
                                            <li>
                                                Bachilleres o egresados con tituloprofesinal en Derecho.
                                            </li>
                                            <li>
                                                Bachilleres o egresados con tituloprofesinal en Derecho.
                                            </li>
                                            <li>
                                                Bachilleres o egresados con tituloprofesinal en Derecho.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-04" role="tabpanel" aria-labelledby="pill-4">
                                <div class="overview-area">
                                    <div class="row">
                                        <div class="col-md-6" style="padding: 10px;">
                                            <h6>¿Necesito tener una carrera para cursar este diplomado?</h6>
                                            <p>
                                                R. Pueden estudiar estudiantes delos últimos ciclos, de la carrera
                                                dederecho, bachilleres,
                                                titulados enDerecho, abogados, jueces, fiscales,efectivos policiales y
                                                criminalística.
                                            </p>
                                        </div>
                                        <div class="col-md-6" style="padding: 10px;">
                                            <h6>¿Cúal es la modalidad y horario de estudios?</h6>
                                            <p>
                                                R. El alumno contará con flexibilidadpara estudiar el día y la hora que
                                                elelija conforme
                                                a su disponibilidad detiempo y espacio desde cualquierdispositivo digital
                                                (Pc, Laptop, móvil)
                                            </p>
                                        </div>
                                        <div class="col-md-6" style="padding: 10px;">
                                            <h6>¿Qué certificados piden las empresas en sus convocatorias para contratar
                                                colaboradores?</h6>
                                            <p>
                                                R. Solicitan que los postulantesacrediten capacitacionesespecializada a
                                                nivel de programas
                                                dediplomados, cursos especializados omaestrías.
                                            </p>
                                        </div>
                                        <div class="col-md-6" style="padding: 10px;">
                                            <h6>¿Las diplomas tienen fecha de bencimiento?</h6>
                                            <p>
                                                R. No tienen fecha de vencimiento,pero se recomienda que el alumnose
                                                actualice
                                                constantementeporque existe una altacompetitividad.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="reviewers-area">
                            <div class="meta-area d-flex">
                                <div class="user-rating ms-0">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    <b>Modalidad de Estudios Mixta</b>
                                </div>
                                <div class="ms-auto">
                                    <i class="fa fa-video" aria-hidden="true"></i>
                                    Google Meet
                                </div>
                                <div class="ms-md-5 ms-auto mb-0">
                                    <a href="">
                                        <i class="fa fa-laptop" aria-hidden="true"></i>
                                        Campus Virtual
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row overview-area">
                        <div class="col-md-12 bg-gray">
                            El alumno obtendrá su diplomado con la siguiente mención:
                            <h5>"Diplomado especializado en Derecho Penal, Nuevo Código Procesal Penal y Técnicas de
                                Litigación Oral"</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 sidebar-area">
                    <div class="widget widget-accordion-inner">
                        <h5 class="widget-title border-0" style="padding: 10px; background-color: #F9FAFD;">Estructura
                            Curricular</h5>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <p style="padding: 5px 15px;">1. La prescripción de la acción en el Nuevo Proceso Penal</p>
                            </div>
                            <div class="accordion-item">
                                <p style="padding: 5px 15px;">2. La prescripción de la acción en el Nuevo Proceso Penal</p>
                            </div>
                            <div class="accordion-item">
                                <p style="padding: 5px 15px;">3. La prescripción de la acción en el Nuevo Proceso Penal</p>
                            </div>
                            <div class="accordion-item">
                                <p style="padding: 5px 15px;">4. La prescripción de la acción en el Nuevo Proceso Penal</p>
                            </div>
                            <div class="accordion-item">
                                <p style="padding: 5px 15px;">5. La prescripción de la acción en el Nuevo Proceso Penal</p>
                            </div>
                            <div class="accordion-item">
                                <p style="padding: 5px 15px;">6. La prescripción de la acción en el Nuevo Proceso Penal</p>
                            </div>
                            <div class="accordion-item">
                                <p style="padding: 5px 15px;">7. La prescripción de la acción en el Nuevo Proceso Penal</p>
                            </div>
                        </div>
                    </div>

                    <div class="price-wrap">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <a class="btn btn-primary" href="#" style="width: 100%;">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                    &nbsp;&nbsp;Comprar Ahora
                                    <b style="text-end"> &nbsp;&nbsp; S/. 250</b>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- courses-details Area End -->


    <!-- Más Populares Area Start-->
    <x-capperu.programas-populares-area></x-capperu.programas-populares-area>
    <!-- Más Populares Area End -->



    <x-capperu.footer-area></x-capperu.footer-area>
@endsection
