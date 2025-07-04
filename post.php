<?php $page = 'index';
include(__DIR__ . '/header.php');
require __DIR__ . '/usr/tool/Parsedown.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    exit('<script>window.location.href="./"</script>');
}
$result = DB::get_row("SELECT * FROM zyyo_article WHERE id=? AND status=1", [$id]);
if (empty($result)) {
    exit('<script>window.location.href="./"</script>');
}
$update_sql = "UPDATE zyyo_article SET views = COALESCE(views, 0) + 1 WHERE id = ?";
DB::query($update_sql, [$id]);
$sql_items = "SELECT * FROM zyyo_category WHERE id = ? ORDER BY power DESC";
$result_items = DB::get_row($sql_items, [$result["category_id"]]); ?>
<div class="post-cover">
    <div class="post_meta">
        <span class="meta">
            <svg id="document" viewBox="0 0 1024 1024">
                <path
                    d="M136 232v560h752V360H525.255a104 104 0 0 1-73.54-30.46L354.178 232H136z m-40-72h274.745a32 32 0 0 1 22.628 9.373l109.254 109.254A32 32 0 0 0 525.255 288H928c17.673 0 32 14.327 32 32v512c0 17.673-14.327 32-32 32H96c-17.673 0-32-14.327-32-32V192c0-17.673 14.327-32 32-32z m296 464h240a8 8 0 0 1 8 8v48a8 8 0 0 1-8 8H392a8 8 0 0 1-8-8v-48a8 8 0 0 1 8-8z"
                    p-id="1913"></path>
            </svg>
            <a href=""> <?= $result_items['name'] ?></a> </span>
    </div>
    <h1 class="post_title">
        <?= $result['title'] ?>
    </h1>

    <div class="post_meta">
        <span class="meta">
            <svg id="user" viewBox="0 0 1024 1024">
                <path
                    d="M853.333333 938.666667c-25.6 0-42.666667-17.066667-42.666666-42.666667v-85.333333c0-72.533333-55.466667-128-128-128H341.333333c-72.533333 0-128 55.466667-128 128v85.333333c0 25.6-17.066667 42.666667-42.666666 42.666667s-42.666667-17.066667-42.666667-42.666667v-85.333333c0-119.466667 93.866667-213.333333 213.333333-213.333334h341.333334c119.466667 0 213.333333 93.866667 213.333333 213.333334v85.333333c0 25.6-17.066667 42.666667-42.666667 42.666667zM512 512c-119.466667 0-213.333333-93.866667-213.333333-213.333333s93.866667-213.333333 213.333333-213.333334 213.333333 93.866667 213.333333 213.333334-93.866667 213.333333-213.333333 213.333333z m0-341.333333c-72.533333 0-128 55.466667-128 128s55.466667 128 128 128 128-55.466667 128-128-55.466667-128-128-128z"
                    p-id="4472"></path>
            </svg>
            <?= $data['title1'] ?>

        </span>
        <span class="meta">
            <svg id="rili" viewBox="0 0 1024 1024">
                <path
                    d="M802.4576 896H233.472A115.6608 115.6608 0 0 1 117.76 780.4928V318.976a115.6608 115.6608 0 0 1 115.712-115.5072h41.8304a30.72 30.72 0 0 1 0 61.44H233.472A54.1696 54.1696 0 0 0 179.2 318.976v461.4656A54.1696 54.1696 0 0 0 233.472 834.56h568.9856a54.1696 54.1696 0 0 0 54.0672-54.0672V318.976a54.1696 54.1696 0 0 0-54.0672-54.0672h-38.7072a30.72 30.72 0 0 1 0-61.44h38.7072A115.6608 115.6608 0 0 1 918.016 318.976v461.4656A115.6608 115.6608 0 0 1 802.4576 896z"
                    p-id="3482"></path>
                <path
                    d="M610.7136 264.9088h-189.44a30.72 30.72 0 0 1 0-61.44h189.44a30.72 30.72 0 1 1 0 61.44zM877.9264 482.304H158.0032a30.72 30.72 0 0 1 0-61.44h719.9232a30.72 30.72 0 0 1 0 61.44zM347.3408 346.7264a30.72 30.72 0 0 1-30.72-30.72V166.4a30.72 30.72 0 0 1 61.44 0v149.6064a30.72 30.72 0 0 1-30.72 30.72zM688.5888 346.7264a30.72 30.72 0 0 1-30.72-30.72V166.4a30.72 30.72 0 0 1 61.44 0v149.6064a30.72 30.72 0 0 1-30.72 30.72z"
                    p-id="3483"></path>

            </svg>
            <?= date('Y年m月d日', strtotime($result['created_time'])) ?>
        </span>



        <span class="meta">
            <svg t="1747238167782" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"
                p-id="1483">
                <path
                    d="M33.651934 947.413717c-18.549471 0-33.630958-15.081487-33.630958-33.630958l0-808.411897c0-18.556635 15.081487-33.645284 33.630958-33.645284 18.556635 0 33.645284 15.08865 33.645284 33.645284l0 774.773775 923.04982 0c18.549471 0 33.630958 15.08865 33.630958 33.638121 0 18.549471-15.081487 33.630958-33.630958 33.630958L33.651934 947.413717zM142.599252 765.715469c-7.294127 0-14.253632-2.319835-20.123316-6.705726-14.85022-11.120268-17.893532-32.243355-6.779404-47.093575l220.624816-294.755164c6.42227-8.570189 16.244986-13.485129 26.963095-13.485129 6.705726 0 13.19451 1.977028 18.758226 5.728468L580.447415 543.010271l349.6054-278.503015c6.019087-4.796236 13.253862-7.331989 20.928658-7.331989 10.314926 0 19.906375 4.617158 26.328645 12.679787 5.601578 7.018857 8.121981 15.804964 7.123234 24.740474-1.006933 8.92016-5.436826 16.923438-12.462846 22.532179L603.069645 611.001805c-5.91471 4.728698-13.358239 7.324826-20.958334 7.324826-6.720052 0-13.217023-1.977028-18.787902-5.728468L371.011428 483.09467l-201.448058 269.127484C163.148263 760.799506 153.317361 765.715469 142.599252 765.715469z"
                    p-id="1484"></path>
            </svg>
            <?= $result['views'] ?>
        </span>
    </div>


</div>
<div class="leftandright">
    <style>
        .main_center {
            display: none;
        }

        .main {
            padding: 20px 0;
        }
    </style>

    <div class="left">



        <div class="post-card">
            <?=
                getPostContent($id);
            ?>


            <div class="post_bottom_1" style="background-image: url(<?= $result['cover'] ?>);">
                <div class="title">
                    <p><?= $result['title'] ?></p>

                </div>
                <div class="details">
                    <div class="item">
                        <p>发布于</p>
                        <!-- 仅显示日期 -->
                        <p><?= date('Y年m月d日', strtotime($result['created_time'])) ?></p>
                    </div>
                    <div class="item">
                        <p>分类</p>
                        <p><a href="#"><?= $result_items['name'] ?></a></p>
                    </div>
                    <div class="item">
                        <p>版权协议</p>
                        <p>MIT</p>
                    </div>
                </div>
            </div>
            <?php

            $prev_article = DB::get_row(
                "SELECT id,title,cover FROM zyyo_article 
    WHERE id < ? AND status=1 
    ORDER BY id DESC LIMIT 1",
                [$id]
            );


            $next_article = DB::get_row(
                "SELECT id,title,cover FROM zyyo_article 
    WHERE id > ? AND status=1 
    ORDER BY id ASC LIMIT 1",
                [$id]
            );
            ?>

            <div class="post_next_prev">
                <?php if ($prev_article): ?>
                    <a class="prev" href="./post.php?id=<?= $prev_article['id'] ?>"
                        style="background-image: url(<?= $prev_article['cover'] ?>);">
                        <span><?= htmlspecialchars($prev_article['title']) ?></span>
                        <div>« 上一篇</div>
                    </a>
                <?php else: ?>
                    <div class="prev" style="background-image: url(<?= $data['author'] ?>);">
                        <div>已经是第一篇</div>
                    </div>
                <?php endif; ?>

                <?php if ($next_article): ?>
                    <a class="next" href="./post.php?id=<?= $next_article['id'] ?>"
                        style="background-image: url(<?= $next_article['cover'] ?>);">
                        <span><?= htmlspecialchars($next_article['title']) ?></span>
                        <div>下一篇 »</div>
                    </a>
                <?php else: ?>
                    <div class="next" style="background-image: url(<?= $data['author'] ?>);">
                        <div>已经是最后一篇</div>
                    </div>
                <?php endif; ?>
            </div>




        </div>
    </div>
    <div class="right">
        <div class="aside_infor">
            <div style="background-image:url(<?= $data['author'] ?>);" class="logo">
                <div class="logo_tips">👏</div>
            </div>
            <h2>
                <?= $data['title1'] ?>
            </h2>
            <p>
                <?= $data['title2'] ?>
            </p>
            <div class="infor">
                <?php $stats = array_pad(explode(",", $data['aside_stats']), 3, ''); ?>
                <div class="item">
                    <p>文章</p>
                    <p><?= $stats[0] ?></p>
                </div>
                <div class="item">
                    <p>标签</p>
                    <p><?= $stats[1] ?></p>
                </div>
                <div class="item">
                    <p>分类</p>
                    <p><?= $stats[2] ?></p>
                </div>
            </div>
            <a href="<?= $data['aside_url'] ?>" class="goto">前往博客</a>
            <span class="contact_me">
                <?php $urls = array_pad(explode(",", $data['icon']), 5, ''); ?>
                <a class="image_box" href="<?= $urls[0] ?>" target="_blank">
                    <svg t="1744987505976" class="icon" viewBox="0 0 1024 1024" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" p-id="1055">
                        <path
                            d="M544.059897 959.266898h-64.949141c-228.633593 0-415.697442-187.063849-415.697442-415.697442v-64.949141c0-228.633593 187.063849-415.697442 415.697442-415.697442h64.949141c228.633593 0 415.697442 187.063849 415.697442 415.697442v64.949141C959.756315 772.203049 772.692466 959.266898 544.059897 959.266898z"
                            fill="#171515" p-id="1056"></path>
                        <path
                            d="M510.25018 263.810197c-136.001664 0-246.287424 110.272449-246.287424 246.317117 0 108.810341 70.566177 201.127938 168.449614 233.700801 12.315293 2.258691 16.811173-5.344681 16.811173-11.87195 0-5.847409-0.212968-21.336746-0.332763-41.891244-68.513287 14.884221-82.969523-33.01723-82.969523-33.01723-11.199258-28.453773-27.346953-36.028477-27.346953-36.028477-22.362679-15.282512 1.691459-14.972275 1.691458-14.972275 24.717616 1.741629 37.727103 25.382117 37.727103 25.382117 21.971555 37.639048 57.645768 26.770506 71.681188 20.46542 2.238213-15.917321 8.600637-26.770506 15.6378-32.927128-54.692882-6.216008-112.191211-27.346953-112.191211-121.73075 0-26.888253 9.596877-48.875166 25.352425-66.092822-2.533092-6.231366-10.985266-31.273553 2.414322-65.183612 0 0 20.680436-6.62249 67.731038 25.249013 19.646312-5.463452 40.715824-8.195178 61.66247-8.2904 20.915929 0.095221 41.987489 2.827971 61.662469 8.2904 47.022957-31.872526 67.664486-25.249012 67.664486-25.249013 13.437471 33.910058 4.98325 58.952245 2.451181 65.183612 15.78524 17.217656 25.317612 39.203545 25.317613 66.092822 0 94.620315-57.587406 115.441023-112.457421 121.538259 8.844321 7.604396 16.721071 22.637081 16.721071 45.612044 0 32.927128-0.302046 59.492857-0.302046 67.56824 0 6.586654 4.436495 14.249412 16.936087 11.843282 97.787192-32.634297 168.295007-124.89046 168.295007-233.672133C756.569344 374.082647 646.281536 263.810197 510.25018 263.810197z"
                            fill="#FFFFFF" p-id="1057"></path>
                    </svg>
                </a>
                <a class="image_box" href="<?= $urls[1] ?>" target="_blank">
                    <svg t="1744987530859" class="icon" viewBox="0 0 1024 1024" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" p-id="1213">
                        <path
                            d="M544.059897 959.266898h-64.949141c-228.633593 0-415.697442-187.063849-415.697442-415.697442v-64.949141c0-228.633593 187.063849-415.697442 415.697442-415.697442h64.949141c228.633593 0 415.697442 187.063849 415.697442 415.697442v64.949141c-0.001024 228.633593-187.064873 415.697442-415.697442 415.697442z"
                            fill="#006CE2" p-id="1214"></path>
                        <path
                            d="M513.358696 494.912378h-84.12549c1.331051-13.311533 4.791783-49.517142 4.791783-70.01635 0-20.499208-0.26621-50.049562-0.26621-50.049563h84.65791v-13.311533c0-17.837106-7.720095-25.823412-14.110163-25.823412H357.08615s4.259363-14.642584 8.252516-29.816564c3.993153-15.175004 13.045323-36.471819 13.045323-36.471819-51.913034 3.460732-55.995265 41.974179-67.354248 76.405394-11.358984 34.431216-20.232998 51.380613-36.73803 88.917273 22.8951 0 45.523989-11.180828 55.107556-26.622042 9.583567-15.441215 13.932008-33.543507 13.932008-33.543507h51.114403v48.629434c0 17.39274-3.194522 72.056954-3.194522 72.056953h-91.225111c-15.973635 0-24.492361 40.28784-24.492361 40.28784h110.215112c-6.921465 62.473387-21.830259 87.498168-42.772809 125.833459-20.94255 38.336314-76.405395 81.907754-76.405395 81.907754 33.809717 9.583567 71.347401-2.928312 87.320012-18.103317 15.973635-15.175004 29.550354-40.998416 39.401155-60.017086 9.849777-19.01867 18.103316-53.659782 18.103317-53.659782l89.449693 110.481322s3.993153-19.966788 5.324204-32.478666c1.331051-12.512903-0.621498-21.741181-3.816021-29.19609-3.194522-7.453885-12.778089-17.748028-25.557201-32.656823-12.778089-14.908794-39.578287-43.57144-39.578287-43.57144s-13.045323 9.583567-23.16131 17.304686c7.453885-18.103316 13.399587-65.667909 13.399587-65.667909h100.808677v-16.683187c0.002048-14.551458-6.031708-24.135025-14.905722-24.135025zM750.117843 329.500632H557.019214a3.54981 3.54981 0 0 0-3.549811 3.54981v358.510375a3.54981 3.54981 0 0 0 3.549811 3.549811h33.145216l12.112563 41.530836 66.820804-41.530836h81.020046a3.54981 3.54981 0 0 0 3.54981-3.549811V333.050442a3.54981 3.54981 0 0 0-3.54981-3.54981zM713.024525 654.112211h-43.128097l-50.714064 32.212457-8.918042-32.212457h-15.441214V368.723631h118.202441V654.112211z"
                            fill="#FFFFFF" p-id="1215"></path>
                    </svg>
                </a>
                <a class="image_box" href="<?= $urls[2] ?>" target="_blank">
                    <svg t="1744987547481" class="icon" viewBox="0 0 1024 1024" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" p-id="1371">
                        <path
                            d="M544.059897 959.266898h-64.949141c-228.633593 0-415.697442-187.063849-415.697442-415.697442v-64.949141c0-228.633593 187.063849-415.697442 415.697442-415.697442h64.949141c228.633593 0 415.697442 187.063849 415.697442 415.697442v64.949141C959.756315 772.203049 772.692466 959.266898 544.059897 959.266898z"
                            fill="#E6162D" p-id="1372"></path>
                        <path
                            d="M466.545635 688.786088c-91.16163 9.191419-169.926056-32.73259-175.86152-93.515542-5.91089-60.857696 63.237205-117.53282 154.373239-126.724239 91.2118-9.191419 169.95063 32.73259 175.811349 93.515542 6.010207 60.857696-63.161438 117.608588-154.272898 126.724239M648.919065 486.853376c-7.764122-2.404083-13.098565-3.93172-9.066504-14.275009 8.815653-22.489641 9.766842-41.873838 0.150511-55.774105-17.85656-25.946278-66.793159-24.543555-122.89286-0.701362 0 0-17.655879 7.814293-13.098565-6.335802 8.590398-28.175276 7.262419-51.716448-6.085975-65.365863-30.404275-31.005295-111.347529 1.127298-180.719855 71.626922-51.891532 52.743405-82.070552 108.767338-82.070552 157.153087 0 92.514182 116.806886 148.813541 231.059177 148.813541 149.765754 0 249.442014-88.406354 249.442015-158.605981 0.074744-42.450286-35.112099-66.543331-66.742989-76.510854M748.395668 317.503768c-34.566369-39.256787-87.6753-56.726319-138.795847-45.656071-11.451133 2.60374-18.668501 13.944294-16.178412 25.420001 2.273025 11.393796 13.351465 18.788296 24.746284 16.516294 0.099317-0.019454 0.199658-0.040955 0.298975-0.061433 35.011759-7.588014 72.929304 3.455613 98.62473 32.432592 24.863007 28.122034 33.092998 67.252884 21.663365 103.007983-3.606124 11.269906 2.504424 23.291343 13.573648 26.947638 11.056938 3.567216 22.912506-2.505447 26.479722-13.562385 0.022525-0.070648 0.045051-0.141296 0.066553-0.211945v-0.05017c16.072952-50.255363 4.481546-105.260531-30.503592-144.756907"
                            fill="#FFFFFF" p-id="1373"></path>
                        <path
                            d="M692.846817 368.468684c-16.828579-19.107748-42.692946-27.591662-67.569264-22.164046-9.889708 2.243333-16.139504 12.020414-14.025181 21.938791 2.154255 9.917353 11.820756 16.278753 21.538451 14.099925 11.695842-2.554594 24.468811 1.151871 33.058186 10.819396 8.590398 9.717696 10.94431 22.915577 7.262419 34.511079-3.081895 9.631689 2.104084 19.960644 11.670244 23.241173 9.533396 3.066537 19.746652-2.174732 22.814213-11.708129 0.017406-0.054266 0.034812-0.108532 0.051195-0.162798 7.513271-23.71728 2.830019-50.739661-14.77569-70.575391M471.555506 578.641624c-3.155615 5.585294-10.218376 8.214632-15.703329 5.885293-5.459357-2.253572-7.137505-8.51463-4.007488-13.899243 3.180188-5.384613 9.94295-8.01395 15.327564-5.86072 5.509527 2.003744 7.4631 8.264802 4.407826 13.899243M442.528357 616.533572c-8.840226 14.275009-27.79951 20.536068-41.974179 13.975011-14.025181-6.511911-18.182156-23.090662-9.366503-37.065673 8.765482-13.899243 26.997808-20.085558 41.12333-14.025181 14.275009 6.261059 18.85792 22.664726 10.192779 37.115843M475.612139 515.354248c-43.401475-11.520758-92.413842 10.518374-111.271761 49.336939-19.283856 39.64484-0.626618 83.648359 43.151647 98.023709 45.455389 14.901627 98.925752-7.96378 117.582991-50.664918 18.382837-41.823668-4.558337-84.900571-49.48745-96.671156"
                            fill="#FFFFFF" p-id="1374"></path>
                    </svg>
                </a>
                <a class="image_box" href="<?= $urls[3] ?>" target="_blank">
                    <svg t="1744987591230" class="icon" viewBox="0 0 1024 1024" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" p-id="1530">
                        <path
                            d="M544.059897 959.266898h-64.949141c-228.633593 0-415.697442-187.063849-415.697442-415.697442v-64.949141c0-228.633593 187.063849-415.697442 415.697442-415.697442h64.949141c228.633593 0 415.697442 187.063849 415.697442 415.697442v64.949141C959.756315 772.203049 772.692466 959.266898 544.059897 959.266898z"
                            fill="#DB4437" p-id="1531"></path>
                        <path d="M305.878574 312.986386h409.365735v387.916361H305.878574V312.986386z" fill="#E67C73"
                            p-id="1532"></path>
                        <path
                            d="M310.328379 312.986386h-9.35524c-22.818308 0-41.416161 19.167133-41.416161 42.807621V658.095125c0 23.640488 18.528229 42.807622 41.416161 42.807622h21.951077V420.55373l187.637225 149.370534 187.637225-149.370534v280.349017h21.951077c22.886909 0 41.416161-19.168157 41.416162-42.807622V355.794007c0-23.640488-18.574304-42.807622-41.416162-42.807621h-9.35524L510.561441 484.262947 310.328379 312.986386z"
                            fill="#FFFFFF" p-id="1533"></path>
                    </svg>
                </a>
                <a class="image_box" href="<?= $urls[4] ?>" target="_blank">
                    <svg t="1745113733506" class="icon" viewBox="0 0 1024 1024" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" p-id="5302">
                        <path
                            d="M512 512m-348.835165 0a348.835165 348.835165 0 1 0 697.67033 0 348.835165 348.835165 0 1 0-697.67033 0Z"
                            fill="#020202" p-id="5303"></path>
                        <path
                            d="M512 755.059341c-174.417582 0-319.578022-128.281319-344.896703-295.947253-2.813187 17.441758-3.938462 34.883516-3.938462 52.887912 0 192.421978 156.413187 348.835165 348.835165 348.835165s348.835165-156.413187 348.835165-348.835165c0-18.004396-1.125275-35.446154-3.938462-52.887912-25.318681 167.665934-170.479121 295.947253-344.896703 295.947253z"
                            fill="#F90606" p-id="5304"></path>
                        <path
                            d="M539.006593 390.47033a90.584615 66.391209 90 1 0 132.782418 0 90.584615 66.391209 90 1 0-132.782418 0Z"
                            fill="#FFFFFF" p-id="5305"></path>
                        <path
                            d="M367.402198 390.47033a90.584615 63.578022 90 1 0 127.156044 0 90.584615 63.578022 90 1 0-127.156044 0Z"
                            fill="#FFFFFF" p-id="5306"></path>
                        <path
                            d="M444.483516 380.905495a33.195604 19.692308 90 1 0 39.384616 0 33.195604 19.692308 90 1 0-39.384616 0Z"
                            fill="#070707" p-id="5307"></path>
                        <path
                            d="M473.740659 380.905495m-4.501099 0a4.501099 4.501099 0 1 0 9.002198 0 4.501099 4.501099 0 1 0-9.002198 0Z"
                            fill="#FFFFFF" p-id="5308"></path>
                        <path
                            d="M605.397802 364.589011c15.753846 0 28.694505 22.505495 28.694506 50.074725h9.564835c0-36.571429-16.879121-66.391209-38.259341-66.391209-20.817582 0-38.259341 29.81978-38.25934 66.391209h9.564835c0-28.131868 12.940659-50.074725 28.694505-50.074725z"
                            fill="#0F0F0F" p-id="5309"></path>
                        <path
                            d="M736.492308 639.718681c0 25.881319-104.087912 71.454945-224.492308 71.454945s-211.551648-45.573626-211.551648-71.454945 97.336264-46.698901 217.740659-46.698901 218.303297 20.817582 218.303297 46.698901z"
                            fill="#FCF865" p-id="5310"></path>
                    </svg>
                </a>
            </span>
        </div>
        <div class="aside_gonggao">
            <div class="title">
                <svg t="1745113220783" class="icon" viewBox="0 0 1024 1024" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" p-id="3332" width="20" height="20">
                    <path
                        d="M844.544 908.8H191.5392c-61.696 0-111.7696-50.0224-111.7696-111.7696v-107.2128h876.4928v107.2128c0 61.7472-50.0224 111.7696-111.7184 111.7696z"
                        fill="#ffa115" p-id="3333"></path>
                    <path
                        d="M853.8624 268.4416h-87.2448l-163.1232-145.1008c-48.6912-43.3152-122.2656-43.4688-171.1616-0.3584L267.4176 268.4416H182.1696c-73.4208 0-133.12 59.6992-133.12 133.12v404.8384c0 73.4208 59.6992 133.12 133.12 133.12h671.6928c73.4208 0 133.12-59.6992 133.12-133.12V401.5616c0-73.4208-59.6992-133.12-133.12-133.12zM472.9856 169.0624c25.6-22.5792 64.1536-22.4768 89.7024 0.2048l111.5136 99.1744h-313.856l112.64-99.3792z m452.5568 637.3376c0 39.5264-32.1536 71.68-71.68 71.68H182.1696c-39.5264 0-71.68-32.1536-71.68-71.68V401.5616c0-39.5264 32.1536-71.68 71.68-71.68h671.6928c39.5264 0 71.68 32.1536 71.68 71.68v404.8384z"
                        fill="#474A54" p-id="3334"></path>
                    <path
                        d="M756.1216 479.744H271.7184c-16.9472 0-30.72 13.7728-30.72 30.72s13.7728 30.72 30.72 30.72h484.4544c16.9472 0 30.72-13.7728 30.72-30.72s-13.7728-30.72-30.7712-30.72zM611.4304 659.1488H271.7184c-16.9472 0-30.72 13.7728-30.72 30.72s13.7728 30.72 30.72 30.72h339.712c16.9472 0 30.72-13.7728 30.72-30.72s-13.7728-30.72-30.72-30.72z"
                        fill="#474A54" p-id="3335"></path>
                </svg>公告栏
            </div>
            <div class="content">
                <?= $data['aside_gonggao'] ?>
            </div>
        </div>
        <div class="aside_infor1">
            <div class="title">
                <svg t="1745113220783" class="icon" viewBox="0 0 1024 1024" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" p-id="3332" width="20" height="20">
                    <path
                        d="M844.544 908.8H191.5392c-61.696 0-111.7696-50.0224-111.7696-111.7696v-107.2128h876.4928v107.2128c0 61.7472-50.0224 111.7696-111.7184 111.7696z"
                        fill="#ffa115" p-id="3333"></path>
                    <path
                        d="M853.8624 268.4416h-87.2448l-163.1232-145.1008c-48.6912-43.3152-122.2656-43.4688-171.1616-0.3584L267.4176 268.4416H182.1696c-73.4208 0-133.12 59.6992-133.12 133.12v404.8384c0 73.4208 59.6992 133.12 133.12 133.12h671.6928c73.4208 0 133.12-59.6992 133.12-133.12V401.5616c0-73.4208-59.6992-133.12-133.12-133.12zM472.9856 169.0624c25.6-22.5792 64.1536-22.4768 89.7024 0.2048l111.5136 99.1744h-313.856l112.64-99.3792z m452.5568 637.3376c0 39.5264-32.1536 71.68-71.68 71.68H182.1696c-39.5264 0-71.68-32.1536-71.68-71.68V401.5616c0-39.5264 32.1536-71.68 71.68-71.68h671.6928c39.5264 0 71.68 32.1536 71.68 71.68v404.8384z"
                        fill="#474A54" p-id="3334"></path>
                    <path
                        d="M756.1216 479.744H271.7184c-16.9472 0-30.72 13.7728-30.72 30.72s13.7728 30.72 30.72 30.72h484.4544c16.9472 0 30.72-13.7728 30.72-30.72s-13.7728-30.72-30.7712-30.72zM611.4304 659.1488H271.7184c-16.9472 0-30.72 13.7728-30.72 30.72s13.7728 30.72 30.72 30.72h339.712c16.9472 0 30.72-13.7728 30.72-30.72s-13.7728-30.72-30.72-30.72z"
                        fill="#474A54" p-id="3335"></path>
                </svg>本站信息
            </div>
            <div class="content">
                <div>本站总访客量：<?php echo htmlspecialchars($sitedata['total_count']); ?>次</div>
                <div>今日访客量：<?php echo htmlspecialchars($sitedata['today_count']); ?>次</div>
                <div>项目/网站总数： <?= DB::count("SELECT COUNT(*) FROM zyyo_item") ?></div>
                <div>已经有<strong>
                        <?= DB::count("SELECT COUNT(*) FROM zyyo_friends WHERE status = 1") ?></strong>位小伙伴入驻本站啦！
                </div>
            </div>
        </div>
    </div>
</div>





<?php include('footer.php') ?>