<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProspectIndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industrues = [
            [ '1' , 'Fabricación de abrasivos y minerales no metálicos' ],
            [ '2' , 'Servicios de alojamiento' ],
            [ '3' , 'Contabilidad' ],
            [ '4' , 'Administración de justicia' ],
            [ '5' , 'Servicios administrativos y de apoyo' ],
            [ '6' , 'Servicios de publicidad' ],
            [ '7' , 'Fabricación de productos químicos agrícolas' ],
            [ '8' , 'Agricultura, construcción, minería fabricación de maquinaria' ],
            [ '9' , 'Gestión del programa de aire, agua y residuos' ],
            [ '10' , 'Aerolíneas y aviación' ],
            [ '11' , 'Resolución de conflicto alternativa' ],
            [ '12' , 'Medicina alternativa' ],
            [ '13' , 'Servicios de ambulancia' ],
            [ '14' , 'Parques de atracciones y salas de juegos' ],
            [ '15' , 'Fabricación de alimentos para animales' ],
            [ '16' , 'Animación y postproducción' ],
            [ '17' , 'Manufactura de ropa' ],
            [ '18' , 'Fabricación de electrodomésticos, electricidad y electrónica' ],
            [ '19' , 'Fabricación de metal estructural y arquitectónico' ],
            [ '20' , 'Arquitectura y urbanismo' ],
            [ '21' , 'Fuerzas armadas' ],
            [ '22' , 'Fabricación de caucho artificial y fibras sintéticas' ],
            [ '23' , 'Artistas y escritores' ],
            [ '24' , 'Fabricación de equipos de audio y video' ],
            [ '25' , 'Fabricación de maquinaria de automatización' ],
            [ '26' , 'Fabricación de componentes aeroespaciales y de aviación' ],
            [ '27' , 'Fabricación de productos horneados' ],
            [ '28' , 'Bancario' ],
            [ '29' , 'Bares, tabernas y discotecas' ],
            [ '30' , 'Bed and breakfast, hostales, casas de familia' ],
            [ '31' , 'Fabricación de bebidas' ],
            [ '32' , 'Generación de energía eléctrica de biomasa' ],
            [ '33' , 'Investigación en biotecnología' ],
            [ '34' , 'Servicios de cadena de bloques' ],
            [ '35' , 'Blogs' ],
            [ '36' , 'Fabricación de calderas, tanques y contenedores de transporte' ],
            [ '37' , 'Edición de libros y periódicos' ],
            [ '38' , 'Publicación de libros' ],
            [ '39' , 'Cervecerías' ],
            [ '40' , 'Producción y distribución de medios de difusión' ],
            [ '41' , 'Construcción de edificio' ],
            [ '42' , 'Contratistas de equipos de construcción' ],
            [ '43' , 'Contratistas de acabados de edificios' ],
            [ '44' , 'Contratistas de estructuras de edificios y exteriores' ],
            [ '45' , 'Consultoría y servicios empresariales' ],
            [ '46' , 'Contenido de empresas' ],
            [ '47' , 'Plataformas de inteligencia de negocios' ],
            [ '48' , 'Capacitación en habilidades comerciales' ],
            [ '49' , 'Programación por cable y satélite' ],
            [ '50' , 'Los mercados de capitales' ],
            [ '51' , 'Caterings' ],
            [ '52' , 'Fabricación de productos químicos' ],
            [ '53' , 'Fabricación de materias primas químicas' ],
            [ '54' , 'Servicios de guardería infantil' ],
            [ '55' , 'Quiroprácticos' ],
            [ '56' , 'Circos y shows de magia' ],
            [ '57' , 'Organizaciones cívicas y sociales' ],
            [ '58' , 'Ingeniería civil' ],
            [ '59' , 'Ajuste de reclamaciones, servicios actuariales' ],
            [ '60' , 'Fabricación de productos de arcilla y refractarios' ],
            [ '61' , 'Minería de carbón' ],
            [ '62' , 'Agencias de cobro' ],
            [ '63' , 'Alquiler de equipos comerciales e industriales' ],
            [ '64' , 'Mantenimiento de maquinaria comercial e industrial' ],
            [ '65' , 'Fabricación de maquinaria para la industria comercial y de servicios' ],
            [ '66' , 'Fabricación de equipos de comunicaciones' ],
            [ '67' , 'Desarrollo comunitario y planificación urbana' ],
            [ '68' , 'Servicios comunitarios' ],
            [ '69' , 'Seguridad informática y de redes' ],
            [ '70' , 'Juegos de computadora' ],
            [ '71' , 'Fabricación de hardware informático' ],
            [ '72' , 'Productos de redes informáticas' ],
            [ '73' , 'Fabricación de computadoras y productos electrónicos' ],
            [ '74' , 'Programas de conservación' ],
            [ '75' , 'Construcción' ],
            [ '76' , 'Fabricación de hardware de construcción' ],
            [ '77' , 'Alquiler de bienes de consumo' ],
            [ '78' , 'Servicio al consumidor' ],
            [ '79' , 'Instituciones correccionales' ],
            [ '80' , 'Escuelas de cosmetología y barbería' ],
            [ '81' , 'Tribunales de justicia' ],
            [ '82' , 'Intermediación de crédito' ],
            [ '83' , 'Fabricación de cuchillería y herramientas manuales' ],
            [ '84' , 'Fabricación de productos lácteos' ],
            [ '85' , 'Compañías de danza' ],
            [ '86' , 'Infraestructura de datos y análisis' ],
            [ '87' , 'Productos de software de seguridad de datos' ],
            [ '88' , 'Fabricación espacial y de defensa' ],
            [ '89' , 'dentistas' ],
            [ '90' , 'Servicios de diseño' ],
            [ '91' , 'Productos de software de computación de escritorio' ],
            [ '92' , 'Destilerías' ],
            [ '93' , 'Proveedores de aprendizaje electrónico' ],
            [ '94' , 'Programas económicos' ],
            [ '95' , 'Educación' ],
            [ '96' , 'Programas de administración rducativa' ],
            [ '97' , 'Fabricación de equipos de iluminación eléctrica' ],
            [ '98' , 'Generación de energía eléctrica' ],
            [ '99' , 'Transmisión, control y distribución de energía eléctrica' ],
            [ '100' , 'Fabricación de equipos eléctricos' ],
            [ '101' , 'Mantenimiento de equipos electrónicos y de precisión' ],
            [ '102' , 'Productos de software integrado' ],
            [ '103' , 'Servicios de emergencia y socorro' ],
            [ '104' , 'Fabricación de motores y equipos de transmisión de potencia' ],
            [ '105' , 'Proveedores de entretenimiento' ],
            [ '106' , 'Programas de calidad ambiental' ],
            [ '107' , 'Servicios ambientales' ],
            [ '108' , 'Servicios de alquiler de equipos' ],
            [ '109' , 'Servicios de eventos' ],
            [ '110' , 'Oficinas ejecutivas' ],
            [ '111' , 'Servicios de búsqueda de ejecutivos' ],
            [ '112' , 'Productos metálicos fabricados' ],
            [ '113' , 'Servicios de instalaciones' ],
            [ '114' , 'Centros de planificación familiar' ],
            [ '115' , 'Agricultura' ],
            [ '116' , 'Agricultura, ganadería, silvicultura' ],
            [ '117' , 'Fabricación de accesorios de moda' ],
            [ '118' , 'Servicios financieros' ],
            [ '119' , 'Escuelas de bellas artes' ],
            [ '120' , 'Protección contra incendios' ],
            [ '121' , 'Pesca' ],
            [ '122' , 'Entrenamiento de vuelo' ],
            [ '123' , 'Fabricación de alimentos y bebidas' ],
            [ '124' , 'Venta al por menor de alimentos y bebidas' ],
            [ '125' , 'Servicios de alimentos y bebidas' ],
            [ '126' , 'Reparación de calzado y marroquinería' ],
            [ '127' , 'Fabricación de calzado' ],
            [ '128' , 'Silvicultura y explotación forestal' ],
            [ '129' , 'Generación de energía eléctrica con combustibles fósiles' ],
            [ '130' , 'Transporte de carga y paquetería' ],
            [ '131' , 'Fabricación de conservas de frutas y verduras' ],
            [ '132' , 'Recaudación de fondos' ],
            [ '133' , 'Fondos y fideicomisos' ],
            [ '134' , 'Fabricación de muebles y accesorios para el hogar' ],
            [ '135' , 'Instalaciones de juego y casinos' ],
            [ '136' , 'Generación de energía eléctrica geotérmica' ],
            [ '137' , 'Fabricación de productos de vidrio' ],
            [ '138' , 'Fabricación de vidrio, cerámica y concreto' ],
            [ '139' , 'Campos de golf y clubes de campo' ],
            [ '140' , 'Administración gubernamental' ],
            [ '141' , 'Servicios de relaciones gubernamentales' ],
            [ '142' , 'Diseño gráfico' ],
            [ '143' , 'Transporte terrestre de pasajeros' ],
            [ '144' , 'Salud y servicios humanos' ],
            [ '145' , 'Educación más alta' ],
            [ '146' , 'Construcción de carreteras, calles y puentes' ],
            [ '147' , 'Lugares históricos' ],
            [ '148' , 'Sociedades de cartera' ],
            [ '149' , 'Servicios de atención médica en el hogar' ],
            [ '150' , 'Horticultura' ],
            [ '151' , 'Hospitalidad' ],
            [ '152' , 'hospitales' ],
            [ '153' , 'Hospitales y sSanidad' ],
            [ '154' , 'Hoteles y moteles' ],
            [ '155' , 'Fabricación de mobiliario doméstico e institucional' ],
            [ '156' , 'Fabricación de electrodomésticos' ],
            [ '157' , 'Servicios domésticos' ],
            [ '158' , 'Vivienda y desarrollo comunitario' ],
            [ '159' , 'Programas de vivienda' ],
            [ '160' , 'Servicios de recursos humanos' ],
            [ '161' , 'Fabricación de equipos de HVAC y refrigeración' ],
            [ '162' , 'Generación de energía hidroeléctrica' ],
            [ '163' , 'Servicios individuales y familiares' ],
            [ '164' , 'Fabricación de maquinaria industrial' ],
            [ '165' , 'Asociaciones industriales' ],
            [ '166' , 'Servicios de información' ],
            [ '167' , 'Seguro' ],
            [ '168' , 'Agencias y corredurías de seguros' ],
            [ '169' , 'Cajas de seguros y beneficios para empleados' ],
            [ '170' , 'Compañías de seguros' ],
            [ '171' , 'Diseño de interiores' ],
            [ '172' , 'Asuntos internacionales' ],
            [ '173' , 'Comercio internacional y desarrollo' ],
            [ '174' , 'Plataformas de mercado de internet' ],
            [ '175' , 'Noticias de internet' ],
            [ '176' , 'Servicios de autobuses interurbanos y rurales' ],
            [ '177' , 'Consejo de inversión' ],
            [ '178' , 'Banca de inversión' ],
            [ '179' , 'Gestión de inversiones' ],
            [ '180' , 'Servicios TI y consultoría TI' ],
            [ '181' , 'Sistema de TI desarrollo de software personalizado' ],
            [ '182' , 'Servicios de datos del sistema de TI' ],
            [ '183' , 'Servicios de diseño de sistemas de TI' ],
            [ '184' , 'Instalación y eliminación de sistemas de TI' ],
            [ '185' , 'Operaciones y mantenimiento del sistema de TI' ],
            [ '186' , 'Pruebas y evaluación de sistemas de TI' ],
            [ '187' , 'Capacitación y soporte del sistema de TI' ],
            [ '188' , 'Servicios de limpieza' ],
            [ '189' , 'Servicios de paisajismo' ],
            [ '190' , 'Escuelas de idiomas' ],
            [ '191' , 'Servicios de lavandería y tintorería' ],
            [ '192' , 'Cumplimiento de la ley' ],
            [ '193' , 'Práctica de la ley' ],
            [ '194' , 'Arrendamiento de bienes raíces no residenciales' ],
            [ '195' , 'Arrendamiento inmobiliario' ],
            [ '196' , 'Agentes y cCorredores de bienes raíces de arrendamiento' ],
            [ '197' , 'Arrendamiento de bienes raíces residenciales' ],
            [ '198' , 'Fabricación de productos de cuero' ],
            [ '199' , 'Servicios legales' ],
            [ '200' , 'Oficinas legislativas' ],
            [ '201' , 'bibliotecas' ],
            [ '202' , 'Fabricación de productos de cal y yeso' ],
            [ '203' , 'Corredores de préstamos' ],
            [ '204' , 'Fabricación de maquinaria' ],
            [ '205' , 'Fabricación de medios magnéticos y ópticos' ],
            [ '206' , 'Fabricación' ],
            [ '207' , 'Transporte marítimo' ],
            [ '208' , 'Investigación de mercado' ],
            [ '209' , 'Servicios de marketing' ],
            [ '210' , 'Fabricación de colchones y persianas' ],
            [ '211' , 'Fabricación de instrumentos de medición y control' ],
            [ '212' , 'Fabricación de productos cárnicos' ],
            [ '213' , 'Medios y telecomunicaciones' ],
            [ '214' , 'Producción de medios' ],
            [ '215' , 'Laboratorios médicos y de diagnóstico' ],
            [ '216' , 'Fabricación de equipos médicos' ],
            [ '217' , 'Prácticas médicas' ],
            [ '218' , 'Cuidado de la salud mental' ],
            [ '219' , 'Minería de minerales metálicos' ],
            [ '220' , 'Tratamientos de metales' ],
            [ '221' , 'Fabricación de válvulas de metal, bolas y rodillos' ],
            [ '222' , 'Fabricación de maquinaria metalúrgica' ],
            [ '223' , 'Asuntos militares e internacionales' ],
            [ '224' , 'Minería' ],
            [ '225' , 'Productos de software de computación móvil' ],
            [ '226' , 'Servicios móviles de alimentos' ],
            [ '227' , 'Aplicaciones de juegos móviles' ],
            [ '228' , 'Fabricación de vehículos de motor' ],
            [ '229' , 'Fabricación de piezas de vehículos de motor' ],
            [ '230' , 'Distribución de películas y videos' ],
            [ '231' , 'Películas y grabación de sonido' ],
            [ '232' , 'Museos' ],
            [ '233' , 'Museos, sitios históricos y zoológicos' ],
            [ '234' , 'Músicos' ],
            [ '235' , 'Investigación en nanotecnología' ],
            [ '236' , 'Distribución de gas natural' ],
            [ '237' , 'Extracción de gas natural' ],
            [ '238' , 'Publicación de periódicos' ],
            [ '239' , 'Organizaciones sin ánimo de lucro' ],
            [ '240' , 'Minería de minerales no metálicos' ],
            [ '241' , 'Construcción de edificios no residenciales' ],
            [ '242' , 'Generación de energía eléctrica nuclear' ],
            [ '243' , 'Hogares de ancianos y centros de atención residencial' ],
            [ '244' , 'Administración de oficina' ],
            [ '245' , 'Fabricación de muebles y accesorios de oficina' ],
            [ '246' , 'Fabricación de productos de petróleo y carbón' ],
            [ '247' , 'Petróleo y gas' ],
            [ '248' , 'Extracción de petróleo' ],
            [ '249' , 'Petróleo, gas y minería' ],
            [ '250' , 'Venta minorista en línea y por correo' ],
            [ '251' , 'Medios de audio y video en línea' ],
            [ '252' , 'Consultoría de operaciones' ],
            [ '253' , 'optometristas' ],
            [ '254' , 'Centros de atención ambulatoria' ],
            [ '255' , 'Consultoría de outsourcing y offshoring' ],
            [ '256' , 'Fabricación de empaques y envases' ],
            [ '257' , 'Fabricación de pinturas, revestimientos y adhesivos' ],
            [ '258' , 'Fabricación de papel y productos forestales' ],
            [ '259' , 'Fondos de la pensión' ],
            [ '260' , 'Las artes escénicas' ],
            [ '261' , 'Artes escénicas y deportes para espectadores' ],
            [ '262' , 'Publicación periódica' ],
            [ '263' , 'Servicios personales y de lavandería' ],
            [ '264' , 'Fabricación de productos de cuidado personal' ],
            [ '265' , 'Servicios de cuidado personal' ],
            [ '266' , 'Servicios para mascotas' ],
            [ '267' , 'Fabricación farmacéutica' ],
            [ '268' , 'Servicios filantrópicos de recaudación de fondos' ],
            [ '269' , 'Fotografía' ],
            [ '270' , 'Terapeutas físicos, ocupacionales y del habla' ],
            [ '271' , 'medicos' ],
            [ '272' , 'Transporte por tubería' ],
            [ '273' , 'Fabricación de productos de plástico y caucho' ],
            [ '274' , 'Fabricación de plásticos' ],
            [ '275' , 'Organizaciones políticas' ],
            [ '276' , 'Servicios postales' ],
            [ '277' , 'Educación primaria y secundaria' ],
            [ '278' , 'Fabricación de metales primarios' ],
            [ '279' , 'Servicios de impresión' ],
            [ '280' , 'Organizaciones profesionales' ],
            [ '281' , 'Servicios profesionales' ],
            [ '282' , 'Programas de asistencia pública' ],
            [ '283' , 'Salud pública' ],
            [ '284' , 'Oficinas de políticas públicas' ],
            [ '285' , 'Servicios de relaciones públicas y comunicaciones' ],
            [ '286' , 'Seguridad pública' ],
            [ '287' , 'Pistas de carreras' ],
            [ '288' , 'Radiodifusión y televisión' ],
            [ '289' , 'Transporte ferroviario' ],
            [ '290' , 'Fabricación de equipos ferroviarios' ],
            [ '291' , 'Ganadería' ],
            [ '292' , 'Ganadería y pesca' ],
            [ '293' , 'Servicios inmobiliarios y de alquiler de equipos' ],
            [ '294' , 'Instalaciones recreativas' ],
            [ '295' , 'Instituciones religiosas' ],
            [ '296' , 'Fabricación de semiconductores de energía renovable' ],
            [ '297' , 'Reparación y mantenimiento' ],
            [ '298' , 'Servicios de investigación' ],
            [ '299' , 'Construcción de edificios residenciales' ],
            [ '300' , 'Restaurantes' ],
            [ '301' , 'Minorista' ],
            [ '302' , 'Ropa y moda al por menor' ],
            [ '303' , 'Venta al por menor de electrodomésticos, equipos eléctricos y electrónicos' ],
            [ '304' , 'Distribuidores minoristas de arte' ],
            [ '305' , 'Suministros de arte al por menor' ],
            [ '306' , 'Venta al por menor de libros y noticias impresas' ],
            [ '307' , 'Venta al por menor de materiales de construcción y equipos de jardinería' ],
            [ '308' , 'Floristerías minoristas' ],
            [ '309' , 'Venta al por menor de muebles y artículos para el hogar' ],
            [ '310' , 'Gasolina al por menor' ],
            [ '311' , 'Comestibles al por menor' ],
            [ '312' , 'Venta al por menor de productos de salud y cuidado personal' ],
            [ '313' , 'Venta al por menor de artículos de lujo y joyería' ],
            [ '314' , 'Venta al por menor de vehículos de motor' ],
            [ '315' , 'Instrumentos musicales al por menor' ],
            [ '316' , 'Equipo de oficina al por menor' ],
            [ '317' , 'Suministros de oficina y regalos al por menor' ],
            [ '318' , 'Venta al por menor de materiales reciclables y mercancías usadas' ],
            [ '319' , 'Restauración de muebles y tapicería' ],
            [ '320' , 'Fabricación de productos de caucho' ],
            [ '321' , 'Telecomunicaciones satelitales' ],
            [ '322' , 'Instituciones de ahorro' ],
            [ '323' , 'Servicios de autobuses escolares y para empleados' ],
            [ '324' , 'Fabricación de productos del mar' ],
            [ '325' , 'Escuelas de secretariado' ],
            [ '326' , 'Bolsas de valores y productos básicos' ],
            [ '327' , 'Seguridad e investigaciones' ],
            [ '328' , 'Guardias de seguridad y servicios de patrulla' ],
            [ '329' , 'Servicios de sistemas de seguridad' ],
            [ '330' , 'Fabricación de semiconductores' ],
            [ '331' , 'Servicios para mayores y discapacitados' ],
            [ '332' , 'Publicación de partituras' ],
            [ '333' , 'Construcción naval' ],
            [ '334' , 'Transporte y servicios de transporte para necesidades especiales' ],
            [ '335' , 'Transporte turístico' ],
            [ '336' , 'Instalaciones de esquí' ],
            [ '337' , 'Fabricación de jabones y productos de limpieza' ],
            [ '338' , 'Plataformas de redes sociales' ],
            [ '339' , 'Desarrollo de software' ],
            [ '340' , 'Generación de energía eléctrica solar' ],
            [ '341' , 'Grabación de sonido' ],
            [ '342' , 'Investigación y tecnología espacial' ],
            [ '343' , 'Contratistas comerciales especializados' ],
            [ '344' , 'Deportes de espectador' ],
            [ '345' , 'Fabricación de artículos deportivos' ],
            [ '346' , 'Instrucción deportiva y recreativa' ],
            [ '347' , 'Equipos deportivos y clubes' ],
            [ '348' , 'Fabricación de productos de resorte y alambre' ],
            [ '349' , 'Dotación de personal y reclutamiento' ],
            [ '350' , 'Suministro de vapor y aire acondicionado' ],
            [ '351' , 'Servicios de gestión estratégica' ],
            [ '352' , 'Subdivisión de tierra' ],
            [ '353' , 'Fabricación de productos de azúcar y confitería' ],
            [ '354' , 'Servicios de taxi y limusina' ],
            [ '355' , 'Formación técnica y profesional' ],
            [ '356' , 'Tecnología e onformación' ],
            [ '357' , 'Tecnología, información e internet' ],
            [ '358' , 'Tecnología, información y medios' ],
            [ '359' , 'telecomunicaciones' ],
            [ '360' , 'Portadores de telecomunicaciones' ],
            [ '361' , 'Centros de llamadas telefónicas' ],
            [ '362' , 'Servicios de ayuda temporal' ],
            [ '363' , 'Manufactura textil' ],
            [ '364' , 'Compañías de teatro' ],
            [ '365' , 'tanques de pensamiento' ],
            [ '366' , 'Fabricación de tabaco' ],
            [ '367' , 'Traducción y localización' ],
            [ '368' , 'Fabricación de equipos de transporte' ],
            [ '369' , 'Programas de transporte' ],
            [ '370' , 'Transporte, logística, cadena de suministro y almacenamiento' ],
            [ '371' , 'Arreglos de viaje' ],
            [ '372' , 'Transporte de camiones' ],
            [ '373' , 'Fideicomisos y sucesiones' ],
            [ '374' , 'Fabricación de productos torneados y tornillería' ],
            [ '375' , 'Servicios de tránsito urbano' ],
            [ '376' , 'Utilidades' ],
            [ '377' , 'Administración de servicios públicos' ],
            [ '378' , 'Construcción de sistemas de servicios públicos' ],
            [ '379' , 'Reparación y mantenimiento de vehículos' ],
            [ '380' , 'Principales de capital de riesgo y capital privado' ],
            [ '381' , 'Servicios veterinarios' ],
            [ '382' , 'Servicios de rehabilitación vocacional' ],
            [ '383' , 'Almacenamiento y depósito' ],
            [ '384' , 'Coleccion de basura' ],
            [ '385' , 'Tratamiento y disposición de residuos' ],
            [ '386' , 'Sistemas de riego y abastecimiento de agua' ],
            [ '387' , 'Servicios de agua, residuos, vapor y aire acondicionado' ],
            [ '388' , 'Servicios de bienestar y fitness' ],
            [ '389' , 'Venta al por mayor' ],
            [ '390' , 'Venta al por mayor bebidas alcohólicas' ],
            [ '391' , 'Venta al por mayor de prendas de vestir y suministros de costura' ],
            [ '392' , 'Mayorista de electrodomésticos, eléctricos y electrónicos' ],
            [ '393' , 'Venta al por mayor materiales de construcción' ],
            [ '394' , 'Venta al por mayor de productos químicos y afines' ],
            [ '395' , 'Venta al por mayor equipo informático' ],
            [ '396' , 'Medicamentos y artículos varios al por mayor' ],
            [ '397' , 'Venta al por mayor de alimentos y bebidas' ],
            [ '398' , 'Venta al por mayor de calzado' ],
            [ '399' , 'Venta al por mayor de muebles y accesorios para el hogar' ],
            [ '400' , 'Venta al por mayor de ferretería, plomería, equipos de calefacción' ],
            [ '401' , 'Importación y exportación al por mayor' ],
            [ '402' , 'Venta al por mayor de artículos de lujo y joyería' ],
            [ '403' , 'Maquinaria al por mayor' ],
            [ '404' , 'Venta al por mayor de metales y minerales' ],
            [ '405' , 'Venta al por mayor de vehículos de motor y repuestos' ],
            [ '406' , 'Venta al por mayor productos de papel' ],
            [ '407' , 'Petróleo y productos derivados del petróleo al por mayor' ],
            [ '408' , 'Venta al por mayor de equipos y suministros de fotografía' ],
            [ '409' , 'Venta al por mayor productos agrícolas crudos' ],
            [ '410' , 'Venta al por mayor materiales reciclables' ],
            [ '411' , 'Generación de energía eléctrica eólica' ],
            [ '412' , 'Bodegas' ],
            [ '413' , 'Servicios inalámbricos' ],
            [ '414' , 'Fabricación de bolsos de mujer' ],
            [ '415' , 'Fabricación de productos de madera' ],
            [ '416' , 'Redacción y edición' ],
            [ '417' , 'Zoológicos y jardines botánicos' ],
        ];

        foreach ($industrues as $industry) {
            ProspectIndustry::create([
                'id' => $industry[0],
                'name' => $industry[1],
            ]);
        }

    }
}
