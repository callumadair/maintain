/**
 * This file is auto generated using 'php artisan typescript:generate'
 *
 * Changes to this file will be lost when the command is run again
 */

declare namespace App.Models {
    export interface Issue {
        id: number;
        title: string;
        description: string | null;
        item_id: number;
        originator_id: number;
        assignee_id: number;
        created_at: string | null;
        updated_at: string | null;
        item?: App.Models.Item | null;
        originator?: App.Models.User | null;
        assignee?: App.Models.User | null;
        images?: Array<App.Models.Image> | null;
        images_count?: number | null;
    }

    export interface User {
        id: number;
        name: string;
        email: string;
        email_verified_at: string | null;
        password: string;
        two_factor_secret: string | null;
        two_factor_recovery_codes: string | null;
        two_factor_confirmed_at: string | null;
        remember_token: string | null;
        current_team_id: number | null;
        profile_photo_path: string | null;
        is_admin: boolean;
        created_at: string | null;
        updated_at: string | null;
        items?: Array<App.Models.Item> | null;
        originated?: Array<App.Models.Issue> | null;
        assigned?: Array<App.Models.Issue> | null;
        items_count?: number | null;
        originated_count?: number | null;
        assigned_count?: number | null;
        readonly profile_photo_url?: any;
    }

    export interface Item {
        id: number;
        name: string;
        description: string | null;
        user_id: number;
        created_at: string | null;
        updated_at: string | null;
        user?: App.Models.User | null;
        issues?: Array<App.Models.Issue> | null;
        images?: Array<App.Models.Image> | null;
        issues_count?: number | null;
        images_count?: number | null;
    }

    export interface Image {
        id: number;
        name: string;
        image_path: string;
        item_id: number | null;
        issue_id: number | null;
        created_at: string | null;
        updated_at: string | null;
        item?: App.Models.Item | null;
        issue?: App.Models.Issue | null;
    }

}
