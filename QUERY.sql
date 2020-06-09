select  sl.subject_code
,   sl.subject_desc
,   sl.lec_unit
,   sl.lab_unit
,   GROUP_CONCAT(sl2.subject_code) as prerequisites
,   count(csp.preq_subj_id) as preq_count
,   count(sts.subject_id) as passed
from curriculum_subj_prereq csp
inner join curriculum_subject cs
on csp.curriculum_subj_id = cs.id
left join curriculum_subject cs2
on csp.preq_subj_id = cs2.id
inner join subject_list sl
on cs.subject_id = sl.id
left join subject_list sl2
on cs2.subject_id = sl2.id
left join student_subject_list sts
on csp.preq_subj_id = sts.subject_id

where csp.curriculum_subj_id not in (

    select subject_id
    from student_subject_list
    where student_id = '$student_id'
    and status = 'PASS'
    )           

group by sl.subject_code

having preq_count = passed

order by cs.year
,    cs.trimester
ASC

select  al.id
    ,   al.password 
    ,   sl.name as student_name
    ,   cl.curriculum_year
    ,   dl.degree_name
from account_list al 
inner join student_list sl 
            on al.student_id = sl.id 
inner join curriculum_list cl 
            on sl.curriculum_id = cl.id 
inner join degree_list dl 
            on cl.degree_id = dl.id 
where al.id = 1