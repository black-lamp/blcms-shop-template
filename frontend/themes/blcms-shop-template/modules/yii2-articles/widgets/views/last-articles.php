<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

use bl\articles\common\entities\Article;

/**
 * @var \yii\web\View $this
 * @var Article[] $articles
 */
?>

<?php foreach($articles as $article): ?>
    <?php $articleUrl = Url::to(['/articles/article/index',
        'id' => $article->id
    ]);
    ?>
    <article>
        <div class="media">
            <div class="media-left">
                <a href="<?= $articleUrl ?>">
                    <img class="media-object" src="<?= $article->getImage('thumbnail', 'small') ?>" alt="">
                </a>
            </div>
            <div class="media-body">
                <a href="<?= $articleUrl ?>">
                    <h4 class="media-heading"><?= $article->translation->name ?></h4>
                </a>
                <time>
                    <?= Yii::$app->formatter->asDate($article->created_at) ?>
                </time>
                <p><?= StringHelper::truncate($article->translation->text, 250) ?></p>
            </div>
        </div>
    </article>
<?php endforeach; ?>
