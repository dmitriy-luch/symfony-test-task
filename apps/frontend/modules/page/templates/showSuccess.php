<h1>Pages List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Url</th>
      <th>Meta</th>
      <th>Content</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $page->getTitle() ?></td>
      <td><?php echo $page->getUrl() ?></td>
      <td><?php echo $page->getMeta() ?></td>
      <td><?php echo $page->getContent() ?></td>
      <td><?php echo $page->getCreatedAt() ?></td>
      <td><?php echo $page->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>
