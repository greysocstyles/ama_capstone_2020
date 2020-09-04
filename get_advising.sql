SELECT
    sl.subject_code,
    sl.subject_desc,
    sl.lec_unit,
    sl.lab_unit,
    cs.year,
    cs.trimester,
    GROUP_CONCAT(DISTINCT sl2.subject_code 
order by
    sl2.subject_code asc separator ', ') AS prerequisites,
    count(DISTINCT csp.preq_subj_id) prereq_count,
    count(DISTINCT a.subject_id) passed 
FROM
    curriculum_subj_prereq csp 
    INNER JOIN
        (   
            SELECT *
            FROM curriculum_subject
            WHERE curriculum_id = 2
        ) as cs 
        ON csp.curriculum_subj_id = cs.id 
    LEFT JOIN
        curriculum_subject cs2 
        ON csp.preq_subj_id = cs2.id 
    INNER JOIN
        subject_list sl 
        ON cs.subject_id = sl.id 
    LEFT JOIN
        subject_list sl2 
        ON cs2.subject_id = sl2.id 
    LEFT JOIN
        (
            SELECT
                subject_id 
            FROM
                student_subject_list 
            WHERE
                student_id = 2
                AND status = 'PASS'
        )
        AS a 
        ON csp.preq_subj_id = a.subject_id 
WHERE
    csp.curriculum_subj_id NOT IN 
    (
        SELECT
            subject_id 
        FROM
            student_subject_list 
        WHERE
            student_id = 2
            AND status = 'PASS' 
    )
GROUP BY
    sl.subject_code 
HAVING
    prereq_count = passed 
ORDER BY
    cs.year asc,
    cs.trimester asc