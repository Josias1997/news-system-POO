<p style="text-align: center">There is actually <?= $nombreNews ?> news. Here there are :</p>


<table>

  <tr><th>Author</th><th>Title</th><th>Date Insert</th><th>Last modification</th><th>Action</th></tr>

<?php

foreach ($listNews as $news)

{

  echo '<tr><td>', $news['author'], '</td><td>', $news['title'], '</td><td>le ', $news['date_add']->format('d/m/Y à H\hi'), '</td><td>', ($news['date_add'] == $news['date_modification'] ? '-' : 'le '.$news['date_modification']->format('d/m/Y à H\hi')), '</td><td><a href="news-update-', $news['id'], '.html"><img src="/images/update.png" alt="Modify" /></a> <a href="news-delete-', $news['id'], '.html"><img src="/images/delete.png" alt="Delete" /></a></td></tr>', "\n";

}

?>

</table>