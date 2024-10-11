export type Article = {
	id: number;
	title: string;
	text: string;
	slug: string;
};

export type Breadcrumb = {
	title: string;
	url: string;
};

export type Activity = {
	id: number;
	title: string;
	week: string;
	course: string;
	worksheet: string;
	answers: string;
};

export type Song = {
	id: number;
	title: string;
	course: string;
	lyrics: string;
	mp3: string;
	order: number;
};

export type Document = {
	id: number;
	url: string;
};

export type Cohort = {
	id: number;
	title: string;
	slug: string;
	course?: Course;
	active: boolean;
};

export type Course = {
	id: number;
	title: string;
	description?: Article;
	activities: Activity[];
	songs: Song[];
	article_id?: number;
	cohort_id?: number;
	access_code?: string;
	reorder_games?: ReorderGame[];
	odd_one_out_games?: OddOneOutGame[];
	category_games?: CategoryGame[];
};

export type ReorderGame = {
	fields: {
		question: string;
		solution: string;
	};
};

export type OddOneOutGame = {
	fields: {
		question: string;
		solution: string;
	};
};

export type CategoryGame = {
	fields: {
		title: string;
		game: string;
	};
};
