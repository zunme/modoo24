<?
class StaffLibrary {
  function allStatics() {
    $sql = "
    SELECT auction_staff_s_uid , COUNT(1) AS cnt
    FROM (
      SELECT 'best' AS ctype, a.auction_staff_s_uid
      FROM post_comments a
      JOIN post_comment_best_logs b ON a.id = b.comment_id
      where b.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-%d 00:00:00')

      UNION ALL

      SELECT 'fav' AS ctype, a.auction_staff_s_uid
      FROM post_comments a
      JOIN post_comment_fav_logs b ON a.id = b.comment_id
      where b.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-%d 00:00:00')
    ) tmp
    GROUP BY auction_staff_s_uid
    ";
    $data =  \DB::select( $sql);
    $res =[];
    foreach ( $data as $row ) {
      $res[ '_'. $row->auction_staff_s_uid ] = $row;
    }
    return $res;
  }
}
