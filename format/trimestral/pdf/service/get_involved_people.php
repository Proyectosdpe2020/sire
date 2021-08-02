<?php
session_start();

$link = $_POST['link'];

$involved_people = array(
    2 => array(
        'elaborated_by' => array(
            'name' => 'Vanessa Pérez Díaz',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. Ma. Guadalupe Pineda Chávez',
            'position' => 'Directora de Carpetas de Investigación y Litigación'
        )
    ),
    3 => array(
        'elaborated_by' => array(
            'name' => 'Nicolasa Aparicio Silva',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic Oscar Miguel Acosta Rosas',
            'position' => 'Titular de la Unidad de Investigación y Persecución al Narcomenudeo de la Fiscalía Especializada para la Atención a Delitos de Alto Impacto'
        )
    ),
    5 => array(
        'elaborated_by' => array(
            'name' => 'Godínez Zarate José Luis',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Alejandro Carrillo Ochoa',
            'position' => 'Fiscal Estatal anticorrupción'
        )
    ),
    6 => array(
        'elaborated_by' => array(
            'name' => 'Teresa Paulina Cazarez Ramírez',
            'position' => 'Ministerio Público'
        ),
        'validated_by' => array(
            'name' => 'Mtro. Jorge Alejandro Montiel Villaseñor',
            'position' => 'Titular de la Agencia de Inteligencia Criminal'
        )
    ),
    9 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Blanca Graciela Arredondo Martínez',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. José Jesús Reyes Mosqueda',
            'position' => 'Fiscal especializado en el Combate a los delitos contra el Ambiente y La Fauna'
        )
    ),
    10 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Erika Olivares Pinto',
            'position' => 'Directora de la unidad de análisis de contexto'
        ),
        'validated_by' => array(
            'name' => 'Mtra. Xochitl Alejandra Martinez Reyna',
            'position' => 'Directora de la unidad de carpetas de investigación'
        ),
        'third_person' => array(
            'name' => 'Mtra. Beatriz Torres Jimenez',
            'position' => 'Directora de litigación',
            'function' => 'Validó'
        )
    ),
    14 => array(
        'elaborated_by' => array(
            'name' => 'Ana Guadalupe Sánchez Maldonado',
            'position' => 'Auxiliar Administrativo'
        ),
        'validated_by' => array(
            'name' => 'Mtra. Isidra Marin Hernandez',
            'position' => 'Directora de Carpetas de Investigación'
        )
    ),
    15 => array(
        'elaborated_by' => array(
            'name' => 'Daniel Pulido Virrueta',
            'position' => 'Enlace de planeación y estadística'
        ),
        'validated_by' => array(
            'name' => 'Lic Armando Montero Juarez',
            'position' => 'Director de Litigación'
        )
    ),
    17 => array(
        'elaborated_by' => array(
            'name' => 'Antonio De  Jesús Pérez Echevarría',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'María Sandra Rodríguez Virelas',
            'position' => 'Agente del Ministerio Publico'
        )
    ),
    18 => array(
        'elaborated_by' => array(
            'name' => 'Antonio De  Jesús Pérez Echevarría',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Joel Alejandro Zuñiga Napoles',
            'position' => 'Agente del Ministerio Publico'
        )
    ),
    21 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Pedro Xochipa Ríos',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. Servando Eduardo Barrera Tafolla',
            'position' => ''
        )
    ),
    26 => array(
        'elaborated_by' => array(
            'name' => 'María Isabel López Mendoza',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Jorge Alberto Camacho Delgado',
            'position' => 'Titular de la Fiscalía de Asuntos Especiales'
        )
    ),
    27 => array(
        'elaborated_by' => array(
            'name' => 'Gema Michell León García',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'José Francisco Moreno Salgado',
            'position' => 'Director de la Unidad de Extinción de Dominio e Inteligencia Patrimonial y Financiera'
        )
    ),
    28 => array(
        'elaborated_by' => array(
            'name' => 'Berta Ambris Cruz',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra. Verónica Guzmán Perez',
            'position' => 'Fiscal de investigación del homicidio doloso contra la mujer y feminicidio'
        )
    ),
    29 => array(
        'elaborated_by' => array(
            'name' => 'Lic Nestor Gerardo Morfin Alvarez',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. Francisco Mederos Cisneros',
            'position' => 'Titular de la Unidad de Robo Contra El Transporte de la Fiscalía Especializada para la Atención a Delitos de Alto Impacto'
        )
    ),
    30 => array(
        'elaborated_by' => array(
            'name' => 'Guadalupe Arreola Guillén',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Nicolas Fernando Rojas López',
            'position' => 'Fiscal Especializado de Homicidio Doloso'
        )
    ),
    31 => array(
        'elaborated_by' => array(
            'name' => 'Sheila Lizbeth Garcia Perez',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'M. en D. Eduardo Agustín Gutiérrez Palacios',
            'position' => 'Titular de la unidad contra el robo de vehiculos'
        )
    ),
    37 => array(
        'elaborated_by' => array(
            'name' => 'Imelda Christiane Rosales Villaseñor',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. Yahveth Pintor Velazquez',
            'position' => 'Directora de Acceso a la Justicia, Centro de Justicia Integral para las Mujeres'
        )
    ),
    38 => array(
        'elaborated_by' => array(
            'name' => 'Mtro. en D. Jonathan Angeles Luna',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Dr Felix López Rosales',
            'position' => 'Fiscal especializado para el delito de tortura, tratos crueles inhumanos o degradantes'
        )
    ),
    67 => array(
        'elaborated_by' => array(
            'name' => 'Honorio lopez ayala',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Marisol Moreno Alvarez',
            'position' => 'coordinadora del centro de mecanismos alternativo de solusion de controversias'
        )
    ),
    69 => array(
        'elaborated_by' => array(
            'name' => 'Erandi Nallely Pérez Muñoz',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Araceli Palomares Miranda',
            'position' => 'Fiscal especializada para la atencion del delito de violencia familiar y de género'
        )
    ),
    70 => array(
        'elaborated_by' => array(
            'name' => 'Mtra. América Yunuén Méndez Silva',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Janeth Martínez Mondragón',
            'position' => 'Fiscal especializada en materia de Derechos Humanos y Libertad de Expresión'
        )
    ),
    71 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Santos Gomez Herrera',
            'position' => 'Director de Carpetas de investigación'
        ),
        'validated_by' => array(
            'name' => 'Mtro Xicotencatl Soria Macedo',
            'position' => 'Fiscal regional de Huetamo'
        )
    ),
    72 => array(
        'elaborated_by' => array(
            'name' => 'Mtro. José Carmen García Mendiola',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Janeth Martínez Mondragón',
            'position' => 'Fiscal especializada en materia de Derechos Humanos y Libertad de Expresión'
        )
    ),
    73 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Antonio Miguel Cano',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Janeth Martínez Mondragón',
            'position' => 'Fiscal especializada en materia de Derechos Humanos y Libertad de Expresión'
        )
    ),
    74 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Karina Esquivel Gutiérrez',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Rodrigo González Ramírez',
            'position' => 'Titular de la Unidad Especializada de Combate al Secuestro'
        )
    ),
    75 => array(
        'elaborated_by' => array(
            'name' => 'Erandi Nallely Pérez Muñoz',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Araceli Palomares Miranda',
            'position' => 'Fiscal especializadapara la atencion del delito de violencia familiar y de género'
        )
    ),
    76 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Hugo Ambriz Carranza',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Andrés Vieyra Castro',
            'position' => 'Director Regional de Carpetas de Investigación'
        )
    ),
    77 => array(
        'elaborated_by' => array(
            'name' => 'Alejandra Espinoza Morales',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. José Manuel Moreno Luna',
            'position' => 'Director de carpetas de investigación de la Fiscalía Regional de Zitácuaro'
        )
    ),
    78 => array(
        'elaborated_by' => array(
            'name' => 'Agustín Pallares Mendoza',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Agustín Pallares Mendoza',
            'position' => 'Encargado del área de carpetas de investigación'
        )
    ),
    79 => array(
        'elaborated_by' => array(
            'name' => 'Mayra Guadalupe Garnica Sosa',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. Luis Gerardo Marín Chávez',
            'position' => 'Director de carpetas de investigación de la Fiscalía Regional de Morelia'
        )
    )
);


$_SESSION['involved_people'] = $involved_people[$link];

echo json_encode($involved_people, JSON_FORCE_OBJECT);


?>
