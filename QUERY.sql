SELECT
    sl.subject_code,
    GROUP_CONCAT(sl2.subject_code) AS prerequisites
FROM
    curriculum_subj_prereq csp
INNER JOIN curriculum_subject cs ON
    csp.curriculum_subj_id = cs.id
LEFT JOIN curriculum_subject cs2 ON
    csp.preq_subj_id = cs2.id
INNER JOIN subject_list sl ON
    cs.subject_id = sl.id
LEFT JOIN subject_list sl2 ON
    cs2.subject_id = sl2.id

where csp.curriculum_subj_id not in (

    select subject_id
    from student_subject_list
    where student_id = 2
    and status = 'PASS'   
)

GROUP by sl.subject_code

having count(csp.preq_subj_id) = 0

UNION

SELECT
    sl.subject_code,
    GROUP_CONCAT(sl2.subject_code) AS prerequisites
FROM
    curriculum_subj_prereq csp
INNER JOIN curriculum_subject cs ON
    csp.curriculum_subj_id = cs.id
LEFT JOIN curriculum_subject cs2 ON
    csp.preq_subj_id = cs2.id
INNER JOIN subject_list sl ON
    cs.subject_id = sl.id
LEFT JOIN subject_list sl2 ON
    cs2.subject_id = sl2.id
left join student_subject_list sts 
    on csp.preq_subj_id = sts.subject_id

where sts.student_id = 2

GROUP by sl.subject_code

having count(csp.preq_subj_id) = count(sts.subject_id)

///



SELECT
    sl.subject_code,
    GROUP_CONCAT(DISTINCT sl2.subject_code) AS prerequisites,
    count(DISTINCT csp.preq_subj_id),
    count(DISTINCT sts.subject_id)
FROM
    curriculum_subj_prereq csp
INNER JOIN curriculum_subject cs ON
    csp.curriculum_subj_id = cs.id
LEFT JOIN curriculum_subject cs2 ON
    csp.preq_subj_id = cs2.id
INNER JOIN subject_list sl ON
    cs.subject_id = sl.id
LEFT JOIN subject_list sl2 ON
    cs2.subject_id = sl2.id
left join student_subject_list sts 
    on csp.preq_subj_id = sts.subject_id

GROUP by sl.subject_code

having count(csp.preq_subj_id) = count(csp.preq_subj_id in (select subject_id from student_subject_list where student_id = 1))