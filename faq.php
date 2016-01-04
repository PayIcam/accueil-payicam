<?php
require_once 'includes/_header.php';
$Auth->allow('member');
$title_for_layout = 'FAQ';
$js_for_layout = array('faq');
include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation
?>
<h1 class="page-header">Foire Aux Questions</h1>
<p>Cette section va tenter de vous répondre aux questions que vous avez : </p>

<section class="faq">
  <h2 class="titreCategoryFaq">Questions générales</h2>
  <dl>
    <dt>Question 1</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 2</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 3</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 4</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 5</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 6</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 7</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 8</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 9</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 10</dt>
    <dd>Répense à la question !</dd>
  </dl>

  <h2 class="titreCategoryFaq">Casper</h2>
  <dl>
    <dt>Question 1</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 2</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 3</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 4</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 5</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 6</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 7</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 8</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 9</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 10</dt>
    <dd>Répense à la question !</dd>
  </dl>

  <h2 class="titreCategoryFaq">Shotgun</h2>
  <dl>
    <dt>Question 1</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 2</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 3</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 4</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 5</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 6</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 7</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 8</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 9</dt>
    <dd>Répense à la question !</dd>
    <dt>Question 10</dt>
    <dd>Répense à la question !</dd>
  </dl>
  <?php if ($Auth->hasRole('admin')): // uniquement pour les admin et super-admin ?> 
    <h2>Pour les administrateurs</h2>
    <h3 class="titreCategoryFaq">Scoobydoo</h3>
    <dl>
      <dt>Question 1</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 2</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 3</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 4</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 5</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 6</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 7</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 8</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 9</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 10</dt>
      <dd>Répense à la question !</dd>
    </dl>

    <h3 class="titreCategoryFaq">Shotgun</h3>
    <dl>
      <dt>Question 1</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 2</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 3</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 4</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 5</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 6</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 7</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 8</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 9</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 10</dt>
      <dd>Répense à la question !</dd>
    </dl>

    <h3 class="titreCategoryFaq">Mozart</h3>
    <dl>
      <dt>Lorem ipsum dolor sit amet.</dt>
      <dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo corrupti, deserunt totam voluptatibus libero nam ut maiores officia? Commodi quia voluptates facilis soluta eos mollitia praesentium laboriosam modi sit dolores porro, omnis? Nisi eos, facilis ea perferendis, natus, optio vitae sit magni tempore, dolorem repellendus? Ex nostrum molestiae, consequatur impedit natus!</dd>
      <dt>Recusandae omnis sapiente sed magni.</dt>
      <dd>Temporibus aliquam eveniet, sed facere sint consequatur aliquid impedit, architecto quaerat, in quos perferendis saepe eos et, odio provident. Eos magnam architecto laudantium sit quasi temporibus, ut quia eveniet amet explicabo est dicta praesentium voluptatum pariatur enim itaque nulla quos facilis distinctio iusto deserunt aspernatur cum. Itaque odit voluptates qui ipsa.</dd>
      <dt>In facilis ab pariatur totam!</dt>
      <dd>Asperiores, voluptatem facilis vero velit quas nisi sunt tempore voluptas? Aliquam explicabo quos voluptatum nulla placeat itaque architecto, voluptates excepturi maxime, dolorem eaque officia nobis nemo ipsum facilis quisquam rerum delectus nihil optio praesentium hic. Expedita ut dolores quia consectetur, nihil repellat similique amet dolorum, recusandae facilis impedit repudiandae in consequatur.</dd>
      <dt>Vitae quos amet ab iusto!</dt>
      <dd>Quam officiis dicta perferendis culpa veritatis nihil voluptas asperiores, pariatur nobis laudantium quas, maxime eaque exercitationem, delectus ullam molestias esse iusto, magnam eum quo eveniet atque qui perspiciatis reiciendis? Laboriosam nemo atque beatae ipsa ullam, iure facere quas obcaecati a! Accusamus veritatis ullam impedit rem blanditiis, perferendis deleniti in quas nemo!</dd>
      <dt>Aperiam dolorum quod, quae soluta.</dt>
      <dd>Quibusdam voluptates, ipsam, odio nobis ducimus aperiam dolore eum sint impedit explicabo, provident libero, mollitia modi placeat temporibus quidem voluptatem cumque deserunt laboriosam natus nulla facilis. Distinctio modi laboriosam possimus quod doloremque quas magnam, quisquam aliquid sapiente omnis ex illo sunt nihil, doloribus reprehenderit eius sed, aliquam rem velit architecto accusamus.</dd>
      <dt>Maxime laborum accusantium, temporibus pariatur.</dt>
      <dd>Voluptate vero, ab quam itaque corporis eius atque natus adipisci quaerat rerum facere suscipit modi incidunt ullam labore quos odio beatae iste totam deleniti! Quisquam necessitatibus quae aut architecto cum, dolor numquam ex quam itaque assumenda quasi deserunt consectetur amet beatae tempore, eaque expedita mollitia nemo. At, doloribus, nostrum! Libero, id.</dd>
    </dl>
  <?php endif ?>

  <?php if ($Auth->hasRole('super-admin')): // uniquement pour les admin et super-admin ?>
    <h2>Pour les super-administrateurs</h2>
    <h3 class="titreCategoryFaq">Scoobydoo</h3>
    <dl>
      <dt>Question 1</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 2</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 3</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 4</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 5</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 6</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 7</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 8</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 9</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 10</dt>
      <dd>Répense à la question !</dd>
    </dl>

    <h3 class="titreCategoryFaq">Admin_Ginger</h3>
    <dl>
      <dt>Question 1</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 2</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 3</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 4</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 5</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 6</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 7</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 8</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 9</dt>
      <dd>Répense à la question !</dd>
      <dt>Question 10</dt>
      <dd>Répense à la question !</dd>
    </dl>
  <?php endif ?>
</section>

<?php include 'includes/footer.php';?>