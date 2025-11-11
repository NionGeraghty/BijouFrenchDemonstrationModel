import { ActivitiesServices } from './activities.service';
import { ArticlesServices } from './articles.service';
import { GroupsServices } from './groups.service';
import { CoursesServices } from './courses.service';
import { SongsServices } from './songs.service';

export class Services {
	groups: GroupsServices;
	courses: CoursesServices;
	articles: ArticlesServices;
	activities: ActivitiesServices;
	songs: SongsServices;

	constructor() {
		this.groups = new GroupsServices();
		this.courses = new CoursesServices();
		this.articles = new ArticlesServices();
		this.activities = new ActivitiesServices();
		this.songs = new SongsServices();
	}
}
