<?php

class UserStats
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    function getStats($dateFrom, $dateTo, $totalClicks = null)
    {
        $sql = "
        SELECT
            CONCAT(first_name, ' ', last_name) as full_name,
            SUM(views) as total_views,
            SUM(clicks) as total_clicks,
            SUM(conversions) as total_conversions,
            ROUND((SUM(conversions) / SUM(clicks)) * 100, 2) as cr,
            DATE_FORMAT(MAX(date), '%Y-%m-%d') as last_date
        FROM users
            JOIN user_stats ON users.id = user_stats.user_id
        WHERE
            users.status = 'active'
            AND user_stats.date >= '$dateFrom'
            AND user_stats.date <= '$dateTo'
        GROUP BY users.id
        ";

        if (!is_null($totalClicks)) {
            $sql .= " HAVING total_clicks >= $totalClicks";
        }

        $result = $this->db->query($sql);

        $stats = [];
        while ($row = $result->fetch_assoc()) {
            $stats[] = $row;
        }

        print_r($stats);
    }
}
