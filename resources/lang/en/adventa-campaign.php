<?php

return [
    'name.required' => 'Enter campaign name.',
    'name.max' => 'Campaign name cannot exceed 255 characters.',
    'date_from.required' => 'Enter the campaign start date.',
    'date_to.required' => 'Enter the campaign end date.',
    'date_from.date_format' => 'Campaign start date must be in the YYYY-MM-DD HH-MM-SS format.',
    'date_to.date_format' => 'Campaign end date must be in the YYYY-MM-DD HH-MM-SS format.',
    'daily_budget.numeric' => 'Value must be a digit.',
    'daily_budget.min' => 'Value must be greater than 0.',
    'budget.numeric' => 'Value must be a digit.',
    'budget.min' => 'Value must be greater than 0.',
    'daily_budget.project_daily_budget_limit' => 'Daily campaign limit cannot exceed that of the project.',
    'budget.user_budget_limit' => 'Campaign budget cannot exceed user’s budget balance.',
    'project_id.required' => 'Specify the project.',
    'project_id.owner_of_project' => 'You can create campaigns in your projects only.',
    'status_global.required' => 'Global campaign status must be indicated.',
    'status_global.in' => 'Global status can take values from 0 to 3.',
    'status_moderation.required' => 'Moderation status must be entered.',
    'status_moderation.in' => 'Moderation status can take values from 0 to 3.',
];